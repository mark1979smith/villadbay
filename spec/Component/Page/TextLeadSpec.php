<?php

namespace spec\App\Component\Page;

use App\Component\Page\TextLead;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TextLeadSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TextLead::class);
    }

    public function it_renders()
    {
        $this->setTextValue("This is a test")
            ->__toString()
            ->shouldBe('<div class="container"><div class="row"><div class="col"><p class="lead">This is a test</p></div></div></div>');
    }

    public function it_renders_with_custom_template()
    {
        $this->setTextValue("This is a test")
            ->setTemplate('<p class="lead">%s</p>')
            ->__toString()
            ->shouldBe('<p class="lead">This is a test</p>');
    }

    public function it_throws_when_custom_template_does_not_have_correct_placeholder_count()
    {
        $this->shouldThrow('\LogicException')
            ->duringSetTemplate('<p class="lead"></p>');
    }
}
