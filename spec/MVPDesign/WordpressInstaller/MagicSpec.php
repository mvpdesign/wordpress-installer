<?php

namespace spec\MVPDesign\WordpressInstaller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MagicSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MVPDesign\WordpressInstaller\Magic');
    }
}
