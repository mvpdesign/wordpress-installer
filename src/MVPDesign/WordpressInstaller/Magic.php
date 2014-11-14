<?php

namespace MVPDesign\WordpressInstaller;

use Composer\Script\Event;
use MVPDesign\WordpressInstaller\Config;

class Magic
{

	public static function happens(Event $event)
	{
		$io = $event->getIO();

		if ($io->isInteractive()) {
			$magicAnswers = Magic::askQuestions($io);
			Magic::createEnvironment($magicAnswers, $io);
		}
	}

	public static function askQuestions($io)
	{

		// if ($generate_salts) {
		// 	$salts = array_map(function($key) {
		// 		return sprintf("%s='%s'", $key, Magic::generateSalt());
		// 	}, self::$KEYS);
		// }

		$db_name     = $io->ask('Database Name?');
		$db_user     = $io->ask('Database User?');
		$db_password = $io->ask('Database Password?');
		$db_host     = $io->ask('Database Host?');
		$wp_env      = $io->askConfirmation('<info>What is the environment</info> [<comment>development</comment>]?', 'development');
		$generate_salts = $io->askConfirmation('<info>Generate salts?</info> [<comment>Y,n</comment>]?', true);

		$config = new Config;

		$config->setDatabaseName($db_name);
		$config->setDatabaseUser($db_user);
		$config->setDatabasePassword($db_password);
		$config->setDatabaseHost($db_host);
		$config->setEnvironment($wp_env);
		$config->setSalts($salts);

		return $config;
	}

	public static function createEnvironment(Config $config, $io)
	{
		$root = dirname(dirname(dirname(__DIR__)));
		$env_file = "{$root}/.env";

		if (copy("{$root}/.env.example", $env_file)) {
		    file_put_contents($env_file, implode($config->salts(), "\n"), FILE_APPEND | LOCK_EX);

		} else {
		    $io->write("<error>An error occured while copying your .env file</error>");
		   	return 1;
		}
	}

	public static function generateSalt($length = 64)
	{
		$chars  = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$chars .= '!@#$%^&*()';
		$chars .= '-_ []{}<>~`+=,.;:/?|';

		$salt = '';

		for ($i = 0; $i < $length; $i++) {
			$salt .= substr($chars, rand(0, strlen($chars) - 1), 1);
		}

		return $salt;
	}
}

class Info {
	public $DB_NAME;
	public $DB_USER;
	public $DB_PASSWORD;
	public $DB_HOST;
	public $WP_ENV;
	public $salts;
}
