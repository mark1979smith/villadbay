<?php

namespace spec\App\Component;

use App\Component\Configuration;
use App\Entity\Config;
use App\Entity\ConfigGroup;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfigurationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith($this->getData());

        $this->shouldHaveType(Configuration::class);
    }

    function it_outputs_one_record()
    {
        $this->beConstructedWith($this->getData());

        $this->render()->shouldBe('test');
    }

    function getData()
    {
        $configGroup = (new ConfigGroup())->setName('Core')->setDescription('Test123');
        return [
            (new Config())->setConfigGroup($configGroup)->setSlug('test-123')->setValue('test')
        ];
    }
}
