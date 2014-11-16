<?php

namespace MVPDesign\WordpressInstaller;

class Config
{   

    /**
     * dbName
     *
     * @var string
     */
    private $dbName;

    /**
     * dbUser
     *
     * @var string
     */
    private $dbUser;

    /**
     * dbPassword
     *
     * @var string
     */
    private $dbPassword;

    /**
     * dbHost
     *
     * @var string
     */
    private $dbHost;

    /**
     * environment
     *
     * @var string
     */
    private $environment;

    /**
     * siteUrl
     *
     * @var string
     */
    private $siteUrl;

    /**
     * salts
     *
     * @var arrray
     */
    private $salts = array(
        'AUTH_KEY'         => null,
        'SECURE_AUTH_KEY'  => null,
        'LOGGED_IN_KEY'    => null,
        'NONCE_KEY'        => null,
        'AUTH_SALT'        => null,
        'SECURE_AUTH_SALT' => null,
        'LOGGED_IN_SALT'   => null,
        'NONCE_SALT'       => null
    );

    /**
     * getDbName
     *
     * @return string
     */
    public function getDbName()
    {
        return $this->dbName;
    }

    /**
     * setDbName
     *
     * @param string $dbName Database name
     *
     * @return void
     */
    public function setDbName($dbName)
    {
        $this->dbName = $dbName;
    }

    /**
     * getDbUser
     *
     * @return string
     */
    public function getDbUser()
    {
        return $this->dbUser;
    }

    /**
     * setDbUser
     *
     * @param string $dbUser Database user
     *
     * @return void
     */
    public function setDbUser($dbUser)
    {
        $this->dbUser = $dbUser;
    }

    /**
     * getDbPassword
     *
     * @return string
     */
    public function getDbPassword()
    {
        return $this->dbPassword;
    }

    /**
     * setDbPassword
     *
     * @param string $dbPassword Database password
     *
     * @return void
     */
    public function setDbPassword($dbPassword)
    {
        $this->dbPassword = $dbPassword;
    }

    /**
     * getDbHost
     *
     * @return string
     */
    public function getDbHost()
    {
        return $this->dbHost;
    }

    /**
     * setDbHost
     *
     * @param string $dbHost Database host
     *
     * @return void
     */
    public function setDbHost($dbHost = 'localhost')
    {
        $this->dbHost = $dbHost;
    }

    /**
     * getEnvironment
     *
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * setEnvironment
     *
     * @param string $environment Environment variable
     *
     * @return void
     */
    public function setEnvironment($environment = 'production')
    {
        $this->environment = $environment;
    }

    /**
     * getSiteUrl
     *
     * @return string
     */
    public function getSiteUrl()
    {
        return $this->siteUrl;
    }

    /**
     * setSiteUrl
     *
     * @param string $url Site url
     *
     * @return void
     */
    public function setSiteUrl($url)
    {
        $this->siteUrl = $url;
    }

    /**
     * getSalt
     *
     * @param string $key Salt key
     *
     * @return string
     */
    public function getSalt($key)
    {
        if ( ! array_key_exists($key, $this->salts)) {
            return false;
        }

        return $this->salts[$key];
    }

    /**
     * setSalt
     *
     * @param string $key Salt key
     * @param string $value Salt value
     *
     * @return void
     */
    public function setSalt($key, $value)
    {
        if ( ! array_key_exists($key, $this->salts)) {
            return false;
        }

        $this->salts[$key] = $value;
    }

    /**
     * getSalts
     *
     * @return string
     */
    public function getSalts()
    {
        return $this->salts;
    }

    /**
     * generate
     *
     * @return array
     */
    public function generate()
    {
        $config = array(
            'DB_NAME'     => $this->getDbName(),
            'DB_USER'     => $this->getDbUser(),
            'DB_PASSWORD' => $this->getDbPassword(),
            'DB_HOST'     => $this->getDbHost(),
            'WP_ENV'      => $this->getEnvironment(),
            'WP_HOME'     => $this->getSiteUrl(),
            'WP_SITE_URL' => $this->getSiteUrl()
        );

        foreach ($this->getSalts() as $key => $value) {
            $config[$key] = $value;
        }

        return $config;
    }
}
