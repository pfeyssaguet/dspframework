<?php

namespace DspFramework\Core;

use DspLib\FileUtils;
class Module
{
	protected $configDir;
	protected $name;
	protected $version;
	protected $namespace;
	protected $description;

	public function __construct($configDir, $name, $version, $namespace, $description)
	{
		$this->configDir = $configDir;
		$this->name = $name;
		$this->version = $version;
		$this->namespace = $namespace;
		$this->description = $description;
	}

	public function getNamespace()
	{
		return $this->namespace;
	}

	public function getRoutes()
	{
		$routes = array();
		$routeFile = $this->configDir . '/routes.xml';
		if (is_readable($routeFile)) {
			$xml = new \SimpleXMLElement($routeFile, null, true);
			foreach ($xml->route as $route) {
				// FIXME gestion des args
				$routes[] = new Route($this, $route->pattern, $route->controller, $route->action);
			}
		}

		return $routes;
	}

	public static function listModules()
	{
		$coreDir = realpath(__DIR__ . '/../../../') . '/modules';
		$appDir = realpath(dirname($_SERVER['SCRIPT_FILENAME']) . '/..') . '/modules';

		$coreModules = FileUtils::getDirs($coreDir);
		$appModules = FileUtils::getDirs($appDir);

		$moduleDirs = array_merge($coreModules, $appModules);

		$modules = array();

		foreach ($moduleDirs as $dir) {
			$packageFile = $dir . '/package.xml';
			$xml = new \SimpleXMLElement($packageFile, null, true);

			$modules[] = new Module($dir, $xml->name, $xml->version, $xml->namespace, $xml->description);
		}
		return $modules;
	}
}
