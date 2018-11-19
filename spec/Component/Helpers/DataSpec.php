<?php

namespace spec\App\Component\Helpers;

use App\Component\Helpers\Data;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DataSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Data::class);
    }

    function it_returns_bool_does_substring_exist()
    {
        $this->doesSubstringExist('test:1', ':')->shouldBeBool();
    }

    function it_returns_true_if_substring_exist()
    {
        $this->doesSubstringExist('test:1', ':')->shouldBe(true);
    }

    function it_returns_bool_does_substring_not_exist()
    {
        $this->doesSubstringExist('test:1', 'abc')->shouldBeBool();
    }

    function it_returns_false_if_substring_not_exist()
    {
        $this->doesSubstringExist('test:1', 'abc')->shouldBe(false);
    }

    function it_throws_when_not_enough_params_does_substring_exist()
    {
        $this->shouldThrow('\LogicException')->during('doesSubstringExist', ['test:1', '']);
    }

    function it_return_string_get_after_substring()
    {
        $this->getAfterSubstring('test:123', ':')->shouldBeString();
    }

    function it_returns_expected_value_get_after_substring()
    {
        $this->getAfterSubstring('test:123', ':')->shouldBe('123');
    }

    function it_returns_whole_string_if_substring_not_found_get_after_substring()
    {
        $this->getAfterSubstring('test123', ':')->shouldBe('test123');
    }

    function it_return_string_get_before_substring()
    {
        $this->getBeforeSubstring('test:123', ':')->shouldBeString();
    }

    function it_returns_expected_value_get_before_substring()
    {
        $this->getBeforeSubstring('test:123', ':')->shouldBe('test');
    }

    function it_returns_whole_string_if_substring_not_found_get_before_substring()
    {
        $this->getBeforeSubstring('test123', ':')->shouldBe('test123');
    }


}
