<?php

namespace MVPDesign\WordpressInstaller;

class Config
{
    private $databaseName;
    private $databaseUser;
    private $databasePassword;
    private $databaseHost;
    private $environment;
    private $wordpressHome;
    private $wordpressSiteUrl;
    private $salts = array(
        'AUTH_KEY' => null,
        'SECURE_AUTH_KEY' => null,
        'LOGGED_IN_KEY' => null,
        'NONCE_KEY' => null,
        'AUTH_SALT' => null,
        'SECURE_AUTH_SALT' => null,
        'LOGGED_IN_SALT' => null,
        'NONCE_SALT' => null
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

    public function wordpressHome()
    {
        return $this->wordpressHome;
    }

    public function setWordpressHome($wordpressHome)
    {
        $this->wordpressHome = $wordpressHome;
    }

    public function wordpressSiteUrl()
    {
        return $this->wordpressSiteUrl;
    }

    public function setWordpressSiteUrl($wordpressSiteUrl)
    {
        $this->wordpressSiteUrl = $wordpressSiteUrl;
    }

    public function salt($key)
    {
        if ( ! array_key_exists($key, $this->salts)) {
            return false;
        }

        return $this->salts[$key];
    }

    public function setSalt($key, $value)
    {
        if ( ! array_key_exists($key, $this->salts)) {
            return false;
        }

        $this->salts[$key] = $value;
    }

    public function salts()
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

        foreach ($this->salts() as $key => $value) {
            $config[$key] = $value;
        }

        return $config;
    }
}
