<?php

namespace MVPDesign\WordpressInstaller;

use Composer\Composer;
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
        $io       = $event->getIO();
        $composer = $event->getComposer();

        $magicAnswers = Magic::askQuestions($io, $composer);
        $answers      = $magicAnswers->generate();
        
        Magic::createEnvironment($answers);
    }

    /**
     * askQuestions
     *
     * @param IOInterface $io Composer io interface
     * @param Composer $composer Composer
     *
     * @return Config
     */
    public static function askQuestions(IOInterface $io, Composer $composer)
    {
        $config   = new Config;
        $defaults = array(
            'dbName'        => 'wordpress',
            'dbUser'        => 'wordpress',
            'dbHost'        => 'localhost',
            'environment'   => 'development',
            'generateSalts' => 'y'
        );

        if($io->isInteractive()){
            $dbName        = $io->ask('<info>Database name</info> [<comment>' . $defaults['dbName'] . '</comment>]:', $defaults['dbName']);
            $dbUser        = $io->ask('<info>Database user</info> [<comment>' . $defaults['dbUser'] . '</comment>]:', $defaults['dbUser']);
            $dbPassword    = $io->ask('<info>Database password</info>:', '');
            $dbHost        = $io->ask('<info>Database host</info> [<comment>' . $defaults['dbHost'] . '</comment>]:', $defaults['dbHost']);
            $environment   = $io->ask('<info>Environment</info> [<comment>' . $defaults['environment'] . '</comment>]:', $defaults['environment']);
            $generateSalts = $io->askConfirmation('<info>Generate salts?</info> [<comment>' . $defaults['generateSalts'] . '</comment>]:', $defaults['generateSalts'] == 'n' ? false : true);

            $config->setDbName($dbName);
            $config->setDbUser($dbUser);
            $config->setDbPassword($dbPassword);
            $config->setDbHost($dbHost);
            $config->setEnvironment($environment);
        } else {
            $composerConfig = $composer->getConfig();
            $generateSalts  = $defaults['generateSalts'] == 'n' ? false : true;

            if($composerConfig){
                $generateSalts = $composerConfig->get('generate-salts');
            }
        }

        if($generateSalts){
            foreach($config->getSalts() as $salt_key => $salt_value){
                $config->setSalt($salt_key, Magic::generateSalt());
            }
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
        $env_file = ".env";

        file_put_contents($env_file, implode("\n", array_map(function ($v, $k) {
            return $k . '=' . $v;
        }, $config, array_keys($config))), LOCK_EX);
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