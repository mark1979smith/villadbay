<?php

namespace spec\App\Component\Page;

use App\Component\Page\ParagraphText;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ParagraphTextSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ParagraphText::class);
    }

    function it_renders_correctly_by_default()
    {
        $this->setTextValue('Hello')
            ->__toString()
            ->shouldBe('<div class="container"><div class="row"><div class="col"><p>Hello</p></div></div></div>');
    }

    function it_renders_correctly_by_modifying_template()
    {
        $this->setTextValue('Hello')
            ->setTemplate('<p>%s</p>')
            ->__toString()
            ->shouldBe('<p>Hello</p>');
    }
}
