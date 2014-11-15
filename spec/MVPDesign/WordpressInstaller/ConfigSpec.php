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
        $this->getDbName();
    }

    public function it_should_set_a_database_name()
    {
        $this->setDbName('name');

        $this->getDbName()->shouldEqual('name');
    }

    public function it_should_return_a_database_user()
    {
        $this->getDbUser();
    }

    public function it_should_set_a_database_user()
    {
        $this->setDbUser('user');

        $this->getDbUser()->shouldEqual('user');
    }

    public function it_should_return_a_database_password()
    {
        $this->getDbPassword();
    }

    public function it_should_set_a_database_password()
    {
        $this->setDbPassword('password');

        $this->getDbPassword()->shouldEqual('password');
    }

    public function it_should_return_a_database_host()
    {
        $this->getDbHost();
    }

    public function it_should_set_a_database_host()
    {
        $this->setDbHost('localhost');

        $this->getDbHost()->shouldEqual('localhost');
    }

    public function it_should_return_a_environment()
    {
        $this->getEnvironment();
    }

    public function it_should_set_a_environment()
    {
        $this->setEnvironment('development');

        $this->getEnvironment()->shouldEqual('development');
    }

    public function it_should_return_a_site_url()
    {
        $this->getSiteUrl();
    }

    public function it_should_set_a_site_url()
    {
        $this->setSiteUrl('http://localhost');

        $this->getSiteUrl()->shouldEqual('http://localhost');
    }

    public function it_should_return_salts()
    {
        $this->getSalts();
    }

    public function it_should_return_salts_as_an_array()
    {
        $this->getSalts()->shouldBeArray();
    }

    public function it_should_set_a_salt()
    {
        $this->setSalt('AUTH_KEY', 'iAmAreallyRandomSalt');

        $this->getSalt('AUTH_KEY')->shouldEqual('iAmAreallyRandomSalt');
    }

    public function it_should_not_set_salts_for_keys_that_do_not_exit()
    {
        $this->setSalt('TEST', 'iAmAreallyRandomSalt');

        $this->getSalt('TEST')->shouldEqual(false);
    }

    public function it_should_generate_an_array()
    {
        $this->generate()->shouldBeArray();
    }
}
