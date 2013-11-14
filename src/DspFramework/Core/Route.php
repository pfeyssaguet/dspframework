<?php

namespace DspFramework\Core;

use DspLib\FileUtils;

class Route
{
	/**
	 * Owner module
	 *
	 * @var Module
	 */
	protected $module;
	protected $pattern;
	protected $controllerName;
	protected $action;
	protected $args = array();

	public function __construct($module, $pattern, $controllerName, $action, $args = array())
	{
		$this->module = $module;
		$this->pattern = $pattern;
		$this->controllerName = $controllerName;
		$this->action = $action;
		$this->args = $args;
	}

	public function getControllerName()
	{
		return $this->module->getNamespace() . '\\' . $this->controllerName;
	}

	public function getAction()
	{
		return $this->action;
	}

	public function getPattern()
	{
		return $this->pattern;
	}

	public static function find($queryString)
	{
		$modules = Module::listModules('MarketplaceBack');

		foreach ($modules as $module) {
			$routes = $module->getRoutes();
			foreach ($routes as $route)
			{
				if ($route->getPattern() == $queryString) {
					return $route;
				}
			}
		}
	}
}
