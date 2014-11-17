<?php

namespace spec\MVPDesign\WordpressInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MagicSpec extends ObjectBehavior
{
    public function getMatchers()
    {
        return array(
            'haveLength' => function ($subject, $length) {
                return strlen($subject) === $length;
            },
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('MVPDesign\WordpressInstaller\Magic');
    }

    public function it_should_return_answers_to_our_questions(IOInterface $io, Composer $composer)
    {
        $this->askQuestions($io, $composer)->shouldReturnAnInstanceOf('MVPDesign\WordpressInstaller\Config');
    }

    public function it_should_generate_a_salt()
    {
        $this->generateSalt()->shouldBeString();
    }

    public function it_should_generate_a_random_salt()
    {
        $salt1 = $this->generateSalt();

        $this->generateSalt()->shouldNotBeEqualTo($salt1);
    }

    public function it_should_generate_a_salt_with_the_specified_length()
    {
        $this->generateSalt(8)->shouldHaveLength(8);
        $this->generateSalt(16)->shouldHaveLength(16);
        $this->generateSalt(32)->shouldHaveLength(32);
        $this->generateSalt()->shouldHaveLength(64);
    }
}
