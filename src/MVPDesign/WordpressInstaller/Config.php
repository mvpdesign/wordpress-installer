<?php

namespace MVPDesign\WordpressInstaller;

class Config
{
	private $databaseName;
	private $databaseUser;
	private $databasePassword;
	private $databaseHost;
	private $environment;

	private $salts = array(
		'AUTH_KEY',
		'SECURE_AUTH_KEY',
		'LOGGED_IN_KEY',
		'NONCE_KEY',
		'AUTH_SALT',
		'SECURE_AUTH_SALT',
		'LOGGED_IN_SALT',
		'NONCE_SALT'
	);

    public function databaseName()
    {
        return $this->databaseName;
    }

    public function setDatabaseName($databaseName)
    {
        $this->databaseName = $databaseName;
    }

    public function databaseUser()
    {
        return $this->databaseUser;
    }

    public function setDatabaseUser($databaseUser)
    {
        $this->databaseUser = $databaseUser;
    }

    public function databasePassword()
    {
        return $this->databasePassword;
    }

    public function setDatabasePassword($databasePassword)
    {
        $this->databasePassword = $databasePassword;
    }

    public function databaseHost()
    {
        return $this->databaseHost;
    }

    public function setDatabaseHost($databaseHost)
    {
        $this->databaseHost = $databaseHost;
    }

    public function environment()
    {
        return $this->environment;
    }

    public function setEnvironment($environment)
    {
        $this->environment = $environment;
    }

    public function salt($key)
    {
        return $this->salts[$key];
    }

    public function setSalt($key, $value)
    {
        $this->salts[$key] = $value;
    }

    public function getSalts()
    {
    	return $this->salts;
    }

    public function generate()
    {
    	$config = array(
			'DB_NAME'     => $this->databaseName(),
			'DB_USER'     => $this->databaseUser(),
			'DB_PASSWORD' => $this->databasePassword(),
			'DB_HOST'     => $this->databaseHost(),
			'WP_ENV'      => $this->environment()
    	);

    	foreach($config->getSalts() as $key => $value) {
    		$config[$key] => $value;
    	}

    	return $config;
    }
}
