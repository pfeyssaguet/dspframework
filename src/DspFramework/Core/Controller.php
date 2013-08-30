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
			throw new ActionNotFoundException();
		}

		$response = call_user_func(array($this, $methodName), $args);
	}
}
