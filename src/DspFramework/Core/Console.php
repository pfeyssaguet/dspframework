<?php

namespace DspFramework\Core;

use DspLib\ConsoleColors;
use DspLib\Console as DspConsole;

class Console
{
	public static function run()
	{
		$title = ConsoleColors::getString('DspFramework', ConsoleColors::FG_GREEN);
		$title .= ' - ' . ConsoleColors::getString('v0.1.0', ConsoleColors::FG_BROWN);
		echo $title . PHP_EOL;

		$cliArgs = $_SERVER['argv'];

		if (count($cliArgs) == 1) {
			$cliArgs[1] = 'help';
		}

		$command = $cliArgs[1];

		if ($command != "help" && $command != "reconfigure") {
			self::checkConfig();
		}

		switch ($command) {
			case "help":
				self::help();
				break;
			case "list":
				self::listPackages();
				break;
			case "list_sources":
				self::listSources();
				break;
			case "reconfigure":
				self::reconfigure();
				break;
			default:
				echo ConsoleColors::showError("Commande [$command] inconnue !").PHP_EOL;
				self::help();
		}

	}

	public static function help()
	{
		$msg = "Utilisation : php dsp.php <commande>" . PHP_EOL;
		$msg .= "  help                  Affiche ce message".PHP_EOL;
		$msg .= "  list                  Affiche les packages installés".PHP_EOL;
		$msg .= "  list_sources          Affiche la liste des dépôts".PHP_EOL;
		$msg .= "  update                Met à jour les versions connues des packages".PHP_EOL;
		$msg .= "  upgrade               Lance les mises à jour de packages".PHP_EOL;
		$msg .= "  install <package>     Installe le package demandé".PHP_EOL;
		$msg .= "  remove <package>      Désinstalle le package demandé".PHP_EOL;
		$msg .= "  search <critère>      Recherche un package correspondant au critère".PHP_EOL;
		$msg .= "  reconfigure           Rétablir les paramètres de configuration".PHP_EOL;
		echo $msg;
	}

	public static function checkConfig()
	{
		$isConfigOK = true;

		if (true) {
			$isConfigOK = false;
		}

		if (!$isConfigOK) {
			$msg = "Des erreurs de configuration ont été trouvées !";
			$msg .= " Veuillez lancer la commande reconfigure pour rétablir la configuration.";
			echo ConsoleColors::showError($msg).PHP_EOL;
			exit(1);
		}
	}

	public static function listPackages()
	{
		$msg = "Liste des packages installés".PHP_EOL;
		echo $msg;
	}

	public static function listSources()
	{
		$msg = "Liste des dépôts".PHP_EOL;
		echo $msg;
	}

	public static function reconfigure()
	{
		echo "Reconfiguration des paramètres".PHP_EOL;

		$host = "";
		while (empty($host)) {
			echo "Serveur de bases de données : ";
			$host = trim(DspConsole::getUserInput());
		}

		$login = "";
		while (empty($login)) {
			echo "Identifiant de connexion à la base de données : ";
			$login = trim(DspConsole::getUserInput());
		}

		$password = "";
		while (empty($password)) {
			echo "Mot de passe de connexion à la base de données : ";
			$password = trim(DspConsole::getUserInput(true));
			echo PHP_EOL;
		}

		$dbName = "";
		while (empty($dbName)) {
			echo "Nom du schéma de la base de données : ";
			$dbName = trim(DspConsole::getUserInput());
		}
	}
}
