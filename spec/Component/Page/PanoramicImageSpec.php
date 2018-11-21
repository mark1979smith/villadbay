<?php

namespace spec\App\Component\Page;

use App\Component\Helpers\ScreenSize;
use App\Component\Page\PanoramicImage;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PanoramicImageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PanoramicImage::class);
    }

    public function it_throws_when_custom_template_does_not_have_correct_placeholder_count()
    {
        $this->shouldThrow('\LogicException')
            ->duringSetTemplate('<div class="container-fluid"><div class="row"><div class="col img-fluid" id="pano">%s</div></div></div>');
    }

    function it_should_return_the_correct_height_xs()
    {
        $screenSize = new ScreenSize(ScreenSize::EXTRA_SMALL);
        $this->getInlineHeight($screenSize)->shouldBe((string) 230);
    }

    function it_should_return_the_correct_height_sm()
    {
        $screenSize = new ScreenSize(ScreenSize::SMALL);
        $this->getInlineHeight($screenSize)->shouldBe((string) 230);
    }

    function it_should_return_the_correct_height_md()
    {
        $screenSize = new ScreenSize(ScreenSize::MEDIUM);
        $this->getInlineHeight($screenSize)->shouldBe((string) 307);
    }

    function it_should_return_the_correct_height_lg()
    {
        $screenSize = new ScreenSize(ScreenSize::LARGE);
        $this->getInlineHeight($screenSize)->shouldBe((string) 320);
    }

    function it_should_return_the_correct_height_xl()
    {
        $screenSize = new ScreenSize(ScreenSize::EXTRA_LARGE);
        $this->getInlineHeight($screenSize)->shouldBe((string) 381);
    }

}
