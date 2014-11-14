<?php

namespace spec\MVPDesign\WordpressInstaller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use MVPDesign\WordpressInstaller\Magic;

class ConfigSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('MVPDesign\WordpressInstaller\Config');
    }

    public function it_should_return_a_database_name()
    {
        $this->databaseName();
    }

    public function it_should_set_a_database_name()
    {
        $this->setDatabaseName('name');

        $this->databaseName()->shouldEqual('name');
    }

    public function it_should_return_a_database_user()
    {
        $this->databaseUser();
    }

    public function it_should_set_a_database_user()
    {
        $this->setDatabaseUser('user');

        $this->databaseUser()->shouldEqual('user');
    }

    public function it_should_return_a_database_password()
    {
        $this->databasePassword();
    }

    public function it_should_set_a_database_password()
    {
        $this->setDatabasePassword('password');

        $this->databasePassword()->shouldEqual('password');
    }

    public function it_should_return_a_database_host()
    {
        $this->databaseHost();
    }

    public function it_should_set_a_database_host()
    {
        $this->setDatabaseHost('localhost');

        $this->databaseHost()->shouldEqual('localhost');
    }

    public function it_should_return_a_environment()
    {
        $this->environment();
    }

    public function it_should_set_a_environment()
    {
        $this->setEnvironment('development');

        $this->environment()->shouldEqual('development');
    }

    public function it_should_return_a_wordpress_home()
    {
        $this->wordpressHome();
    }

    public function it_should_set_a_wordpress_home()
    {
        $this->setWordpressHome('http://localhost');

        $this->wordpressHome()->shouldEqual('http://localhost');
    }

    public function it_should_return_a_wordpress_site_url()
    {
        $this->wordpressSiteUrl();
    }

    public function it_should_set_a_wordpress_site_url()
    {
        $this->setWordpressSiteUrl('http://localhost/wp');

        $this->wordpressSiteUrl()->shouldEqual('http://localhost/wp');
    }

    public function it_should_return_salts()
    {
        $this->salts();
    }

    public function it_should_return_salts_as_an_array()
    {
        $this->salts()->shouldBeArray();
    }

    public function it_should_set_a_salt()
    {
        $this->setSalt('AUTH_KEY', 'iAmAreallyRandomSalt');

        $this->salt('AUTH_KEY')->shouldEqual('iAmAreallyRandomSalt');
    }

    public function it_should_not_set_salts_for_keys_that_do_not_exit()
    {
        $this->setSalt('TEST', 'iAmAreallyRandomSalt');

        $this->salt('TEST')->shouldEqual(false);
    }

    public function it_should_generate_an_array()
    {
        $this->generate()->shouldBeArray();
    }
}
