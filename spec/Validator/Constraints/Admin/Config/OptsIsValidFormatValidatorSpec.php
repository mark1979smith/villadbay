<?php

namespace spec\App\Validator\Constraints\Admin\Config;

use App\Validator\Constraints\Admin\Config\OptsIsValidFormatValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class OptsIsValidFormatValidatorSpec
 *
 * @package spec\App\Validator\Constraints\Admin\Config
 */
class OptsIsValidFormatValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(OptsIsValidFormatValidator::class);
    }

    function it_throws_when_given_string()
    {
        $this->shouldThrow('\TypeError')->during('isValid', ['abcsss']);
    }

    function it_returns_boolean()
    {
        $this->isValid(['abcsss', 'abcd:yyy'])->shouldBeBool();
    }

    function it_returns_true_when_correct_format()
    {
        $this->isValid([
            'this - is the data:This is my label',
            'this is-an option:This is a valid label',
            'this is a value that is both label and data',
        ])->shouldBe(true);
    }

    function it_returns_false_when_text_after_colon_missing()
    {
        $this->isValid(['abc', 'abccff:'])->shouldBe(false);
    }

    function it_returns_false_when_text_before_colon_missing()
    {
        $this->isValid(['abc', ':abccff'])->shouldBe(false);
    }

    function it_doesnt_validate_when_empty_entry()
    {
        $this->isValid(['abc', '', 'abccff'])->shouldBe(false);
    }

    function it_returns_no_separator_when_one_list_of_values()
    {
        $array = new \ArrayIterator();
        $array->append('Test123:');
        $this->getErrorMessage($array)->shouldBe('"Test123:"');
    }

    function it_returns_message_when_colon_before_value()
    {
        $array = new \ArrayIterator();
        $array->append(':Test123');
        $this->getErrorMessage($array)->shouldBe('":Test123"');
    }

    function it_ignores_spacing_when_one_list_of_values()
    {
        $array = new \ArrayIterator();
        $array->append(' Test123:');
        $this->getErrorMessage($array)->shouldBe('"Test123:"');
    }

    function it_returns_and_separated_when_two_list_of_values()
    {
        $array = new \ArrayIterator();
        $array->append('Test123:');
        $array->append('Test124:');
        $this->getErrorMessage($array)->shouldBe('"Test123:" and "Test124:"');
    }

    function it_ignores_spacing_when_two_list_of_values()
    {
        $array = new \ArrayIterator();
        $array->append(' Test123:');
        $array->append('Test124: ');
        $this->getErrorMessage($array)->shouldBe('"Test123:" and "Test124:"');
    }

    function it_returns_comma_separated_when_greater_than_two_list_of_values()
    {
        $array = new \ArrayIterator();
        $array->append('Test123:');
        $array->append('Test124:');
        $array->append('Test125:');
        $this->getErrorMessage($array)->shouldBe('"Test123:", "Test124:" and "Test125:"');
    }

    function it_ignores_spacing_when_greater_than_two_list_of_values()
    {
        $array = new \ArrayIterator();
        $array->append(' Test123:');
        $array->append('Test124: ');
        $array->append(' Test125: ');
        $this->getErrorMessage($array)->shouldBe('"Test123:", "Test124:" and "Test125:"');
    }

    function it_ignores_spacing()
    {
        $array = new \ArrayIterator();
        $array->append(' Test123: ');
        $array->append('Test124:');
        $this->getErrorMessage($array)->shouldBe('"Test123:" and "Test124:"');
    }


    function it_returns_null_message_when_correct_format()
    {
        $this->getIncorrectFormatSection([
            ["This is a standalone label and data", "This is a standalone label and data", "", ""],
            ["This is data:This is label", "This is data", ":", "This is label"],
        ])->shouldBe(null);
    }

    function it_returns_array_message_when_incorrect_format()
    {
        $this->getIncorrectFormatSection([
            ["This is a standalone label and data", "This is a standalone label and data", "", ""],
            ["This is data:This is label", "This is data", ":", "This is label"],
            ["This is data:", "This is data", ":", ""],
        ])->shouldHaveType('ArrayIterator');
    }

    function it_returns_one_message_when_incorrect_format()
    {
        $this->getIncorrectFormatSection([
            ["This is a standalone label and data", "This is a standalone label and data", "", ""],
            ["This is data:This is label", "This is data", ":", "This is label"],
            ["This is data:", "This is data", ":", ""],
        ])->shouldHaveCount(1);
    }

    function it_returns_the_message_when_incorrect_format()
    {
        $this->getIncorrectFormatSection([
            ["This is a standalone label and data", "This is a standalone label and data", "", ""],
            ["This is data:This is label", "This is data", ":", "This is label"],
            ["This is data:", "This is data", ":", ""],
        ])->current()->shouldBe('This is data:');
    }


}
