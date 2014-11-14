<?php

namespace spec\MVPDesign\WordpressInstaller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use MVPDesign\WordpressInstaller\Magic;

class ConfigSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MVPDesign\WordpressInstaller\Config');
    }

    function it_should_return_a_database_name()
    {
        $this->databaseName();
    }

    function it_should_set_a_database_name()
    {
        $this->setDatabaseName('name');

        $this->databaseName()->shouldEqual('name');
    }

    function it_should_return_a_database_user()
    {
        $this->databaseUser();
    }

    function it_should_set_a_database_user()
    {
        $this->setDatabaseUser('user');

        $this->databaseUser()->shouldEqual('user');
    }

    function it_should_return_a_database_password()
    {
        $this->databasePassword();
    }

    function it_should_set_a_database_password()
    {
        $this->setDatabasePassword('password');

        $this->databasePassword()->shouldEqual('password');
    }

    function it_should_return_a_database_host()
    {
        $this->databaseHost();
    }

    function it_should_set_a_database_host()
    {
        $this->setDatabaseHost('localhost');

        $this->databaseHost()->shouldEqual('localhost');
    }

    function it_should_return_a_environment()
    {
        $this->environment();
    }

    function it_should_set_a_environment()
    {
        $this->setEnvironment('development');

        $this->environment()->shouldEqual('development');
    }

    function it_should_return_salts()
    {
        $this->salts();
    }

    function it_should_set_salts(Magic $magician)
    {
        $salts = array();
        $salts[] = $magician->generateSalt();
        $salts[] = $magician->generateSalt();

        $this->setSalts($salts);

        $this->salts()->shouldEqual($salts);
    }

    function it_should_return_salts_as_an_array()
    {
        $this->salts()->shouldBeArray();
    }
}
