<?php

namespace spec\App\Component\Page;

use App\Component\Page\ListGroup;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ListGroupSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ListGroup::class);
    }

    function it_renders_normal_list()
    {
        $this->setListItems(['list 1'])->__toString()
            ->shouldBe('<div class="container"><div class="row"><div class="col"><ul class="list-group list-group-flush"><li class="list-group-item">list 1</li></ul></div></div></div>');
    }

    function it_renders_custom_css_list()
    {
        $this->setListItems(['list 1'])
            ->setCssClass('test-css-class')
            ->__toString()
            ->shouldBe('<div class="container"><div class="row"><div class="col"><ul class="test-css-class"><li class="list-group-item">list 1</li></ul></div></div></div>');
    }

    function it_renders_custom_template_list()
    {
        $this->setListItems(['list 1'])
            ->setTemplate('<div class="container"><div class="row"><div class="col-3"><ul class="%s">%s</ul></div></div></div>')
            ->__toString()
            ->shouldBe('<div class="container"><div class="row"><div class="col-3"><ul class="list-group list-group-flush"><li class="list-group-item">list 1</li></ul></div></div></div>');
    }

    function it_renders_multiple_items()
    {
        $this->setListItems(['list 1', 'list 2'])
            ->__toString()
            ->shouldBe('<div class="container"><div class="row"><div class="col"><ul class="list-group list-group-flush"><li class="list-group-item">list 1</li><li class="list-group-item">list 2</li></ul></div></div></div>');
    }
}
