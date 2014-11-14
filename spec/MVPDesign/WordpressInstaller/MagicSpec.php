<?php

namespace spec\MVPDesign\WordpressInstaller;

use PhpSpec\IO\IOInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MagicSpec extends ObjectBehavior
{
    public function getMatchers()
    {
        return [
            'haveLength' => function($subject, $length) {
                return strlen($subject) === $length;
            },
        ];
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('MVPDesign\WordpressInstaller\Magic');
    }

    /*
     * How are you suppose to get anywhere without help?
     *
     * @method askQuestions
     */

    public function it_should_ask_questions()
    {
        //$this->askQuestions()->shouldBeCalled();
    }

    public function it_should_return_answers_to_our_questions(IOInterface $io)
    {
        $io->askConfirmation()->shouldBeCalled();
        $io->askConfirmation("", true)->willReturn(true);

        $this->askQuestions($io)->shouldReturnAnInstanceOf('MVPDesign\WordpressInstaller\Config');
    }

    /*
     * From the bachelor pad to the family household.
     * We need to be prepared for any type of environment.
     *
     * @method createEnvironment
     */

    /*
     * Extra Salty generation
     * 
     * @method generateSalt
     */

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
