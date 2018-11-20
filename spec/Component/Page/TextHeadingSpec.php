<?php

namespace spec\App\Component\Page;

use App\Component\Page\TextHeading;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TextHeadingSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TextHeading::class);
    }

    public function it_throws_when_custom_template_does_not_have_correct_placeholder_count()
    {
        $this->shouldThrow('\LogicException')
            ->duringSetTemplate('<div class="container"><div class="row"><div class="%s"><%s class="%s">%s</%s></div></div></div>');
    }

    function it_renders_h1()
    {
        $this->setType((new TextHeading\Type())->setValue('h1'))
            ->setTextValue((new TextHeading\TextValue())->setValue('This is my test'))
            ->setSizeClass((new TextHeading\SizeClass())->setValue(''))
            ->setColourClass((new TextHeading\ColourClass())->setValue(''))
            ->setAlignClass((new TextHeading\AlignClass())->setValue(''))
            ->__toString()
            ->shouldBe('<div class="container"><div class="row"><div class="col"><h1 class="">This is my test</h1></div></div></div>');
    }

    function it_renders_h1_with_size()
    {
        $this->setType((new TextHeading\Type())->setValue('h1'))
            ->setTextValue((new TextHeading\TextValue())->setValue('This is my test'))
            ->setSizeClass((new TextHeading\SizeClass())->setValue('display-3'))
            ->setColourClass((new TextHeading\ColourClass())->setValue(''))
            ->setAlignClass((new TextHeading\AlignClass())->setValue(''))
            ->__toString()
            ->shouldBe('<div class="container"><div class="row"><div class="col"><h1 class="display-3">This is my test</h1></div></div></div>');
    }

    function it_renders_h1_with_size_and_colour()
    {
        $this->setType((new TextHeading\Type())->setValue('h1'))
            ->setTextValue((new TextHeading\TextValue())->setValue('This is my test'))
            ->setSizeClass((new TextHeading\SizeClass())->setValue('display-3'))
            ->setColourClass((new TextHeading\ColourClass())->setValue('text-dark'))
            ->setAlignClass((new TextHeading\AlignClass())->setValue(''))
            ->__toString()
            ->shouldBe('<div class="container"><div class="row"><div class="col"><h1 class="display-3 text-dark">This is my test</h1></div></div></div>');
    }

    function it_renders_h1_with_size_and_colour_and_align()
    {
        $this->setType((new TextHeading\Type())->setValue('h1'))
            ->setTextValue((new TextHeading\TextValue())->setValue('This is my test'))
            ->setSizeClass((new TextHeading\SizeClass())->setValue('display-3'))
            ->setColourClass((new TextHeading\ColourClass())->setValue('text-dark'))
            ->setAlignClass((new TextHeading\AlignClass())->setValue('text-center'))
            ->__toString()
            ->shouldBe('<div class="container"><div class="row"><div class="col"><h1 class="display-3 text-dark text-center">This is my test</h1></div></div></div>');
    }

}
