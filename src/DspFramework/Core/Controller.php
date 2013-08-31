<?php

namespace DspFramework\Core;

use DspFramework\Core\ActionNotFoundException;

abstract class Controller
{
	/**
	 * Launch said action and returns the response
	 *
	 * @param string $name Action name
	 * @param array $args Action args
	 * @throws ActionNotFoundException
	 * @return DspFramework\Core\Response
	 */
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
		return $response;
	}

	/**
	 * Runs the application
	 * @param string $appName Application name
	 * @throws \InvalidArgumentException
	 */
	public static function run($appName)
	{
		$className = '\\' . $appName . '\\' . $appName . 'FrontController';
		if (!class_exists($className))
		{
			throw new \InvalidArgumentException("Class $className does not exists !");
		}

		if (!is_subclass_of($className, __CLASS__))
		{
			throw new \InvalidArgumentException("Class $className is not a subclass of " . __CLASS__ . " !");
		}

		$frontController = new $className();
		$response = $frontController->actionLaunch('default');
		$response->run();
	}
}
