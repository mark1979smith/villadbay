<?php

namespace spec\App\Component\Config;

use App\Component\Config\Groups;
use App\Entity\ConfigGroup;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GroupsSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith($this->getData());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Groups::class);
    }

    function it_should_return_iterator()
    {
        $this->getGroups()->shouldHaveType('ArrayIterator');
    }

    function it_should_have_one_group()
    {
        $this->getGroups()->shouldHaveCount(2);
    }

    function it_should_have_value()
    {
        $this->getGroups()->current()->getName()->shouldBe('Core');
    }

    function it_should_have_lowercase_slug()
    {
        $this->getGroups()->current()->getSlug()->shouldBe('core');
    }

    function it_should_have_hyphenated_non_allowed_chars()
    {
        $this->getGroups()[1]->getSlug()->shouldBe('navigation-options');
    }

    function getData()
    {
        return [
            (new ConfigGroup())->setName('Core')->setDescription('Test123'),
            (new ConfigGroup())->setName('Navigation Options')->setDescription('')
        ];
    }
}
