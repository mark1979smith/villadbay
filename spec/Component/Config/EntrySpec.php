<?php

namespace spec\App\Component\Config;

use App\Component\Config\Entry;
use App\Entity\Config;
use App\Entity\ConfigGroup;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class EntrySpec
 *
 * @package spec\App\Component
 */
class EntrySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith($this->getData());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Entry::class);
    }
    function it_should_have_3_entries()
    {
        $this->callOnWrappedObject('getData')->offsetGet('test-123')->shouldHaveCount(3);
    }

    function it_should_be_iterator_when_no_slug_provided()
    {
        $this->getLatestRevision()->shouldHaveType('ArrayIterator');
    }

    function it_should_be_entity_when_slug_provided()
    {
        $this->getLatestRevision('test-123')->shouldHaveType('App\Entity\Config');
    }

    function it_should_contain_key_when_no_slug_provided()
    {
        $this->getLatestRevision()->shouldHaveKey('test-123');
    }

    function it_should_have_value_test2_when_slug_provided()
    {
        $this->getLatestRevision('test-123')->getValue()->shouldBe('test2');
    }

    function it_should_be_entity_value_when_no_slug_provided()
    {
        $this->getLatestRevision()->offsetGet('test-123')->shouldHaveType('App\Entity\Config');
    }

    function it_should_have_value_test2_only_when_no_slug_provided()
    {
        $this->getLatestRevision()->offsetGet('test-123')->getValue()->shouldBe('test2');
    }

    function getData()
    {
        $configGroup = (new ConfigGroup())->setName('Core')->setDescription('Test123');
        return [
            (new Config())->setConfigGroup($configGroup)->setSlug('test-123')->setCreated(new \DateTimeImmutable('2018-11-16 00:00:00'))->setValue('test')
            ,(new Config())->setConfigGroup($configGroup)->setSlug('test-123')->setCreated(new \DateTimeImmutable('2018-11-16 02:00:00'))->setValue('test2')
            ,(new Config())->setConfigGroup($configGroup)->setSlug('test-123')->setCreated(new \DateTimeImmutable('2018-11-16 01:00:00'))->setValue('test1')
        ];
    }
}
