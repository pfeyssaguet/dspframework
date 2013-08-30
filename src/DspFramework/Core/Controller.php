<?php

namespace DspFramework\Core;

use DspFramework\Core\ActionNotFoundException;

abstract class Controller
{
	private function actionLaunch($name, $args = array())
	{
		$methodName = $name . 'Action';
		if (!method_exists($this, $methodName))
		{
			$message = "Action $name of controller " . get_class($this) . " does not exists";
			$message .= " (method " . get_class($this) . "::$methodName not found)";
			throw new ActionNotFoundException($message);
		}

		$response = call_user_func(array($this, $methodName), $args);
	}

	public static function run($appName)
	{
		$className = $appName . '\\' . $appName . 'FrontController';
		if (!class_exists($className))
		{
			throw new \InvalidArgumentException("Class $className does not exists !");
		}

		if (!is_subclass_of($className, __CLASS__))
		{
			throw new \InvalidArgumentException("Class $className is not a subclass of " . __CLASS__ . " !");
		}

		$frontController = new $className();
		$frontController->actionLaunch('default');
	}
}
