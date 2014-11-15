<?php

namespace MVPDesign\WordpressInstaller;

use Composer\Script\Event;
use Composer\IO\IOInterface;
use MVPDesign\WordpressInstaller\Config;

class Magic
{

    /**
     * happens
     *
     * @param Event $event Composer Event
     *
     * @return void
     */
	public static function happens(Event $event)
	{
		$io 		  = $event->getIO();
		$magicAnswers = Magic::askQuestions($io);
		$answers      = $magicAnswers->generate();
		
		Magic::createEnvironment($answers);
	}

    /**
     * askQuestions
     *
     * @param IOInterface $io Composer io interface
     *
     * @return Config
     */
	public static function askQuestions(IOInterface $io)
	{
        $config = new Config;

		if ( ! $io->isInteractive()) {
			return $config;
		}

		$dbName     = $io->ask('Database Name?');
		$dbUser     = $io->ask('Database User?');
		$dbPassword = $io->ask('Database Password?');
		$db_host     = $io->ask('Database Host?');
		$wp_env      = $io->askConfirmation('<info>What is the environment</info> [<comment>development</comment>]?', 'development');
		$generate_salts = $io->askConfirmation('<info>Generate salts?</info> [<comment>Y,n</comment>]?', true);

        $config->setDbName($db_name);
		$config->setDbUser($db_user);
		$config->setDbPassword($db_password);
		$config->setDbHost($db_host);
		$config->setEnvironment($wp_env);
        foreach($config->getSalts() as $salt_key => $salt_value){
            $config->setSalt($salt_key, Magic::generateSalt());
        }

		return $config;
	}

    /**
     * createEnvironment
     *
     * @param array $config Config variables
     *
     * @return void
     */
	public static function createEnvironment($config)
	{
		$root = dirname(dirname(dirname(__DIR__)));
		$env_file = "{$root}/.env";

        file_put_contents($env_file, implode("\n", array_map(function ($v, $k) {
            return $k . '=' . $v;
        }, $config, array_keys($config))), FILE_APPEND | LOCK_EX);
	}

    /**
     * generateSalt
     *
     * @param string $length Length of salt
     *
     * @return string
     */
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