<?php

namespace spec\App\Component\Helpers;

use App\Component\Helpers\ScreenSize;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ScreenSizeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('sm');
        $this->shouldHaveType(ScreenSize::class);
    }

    function it_should_throw_when_constructed_with_incorrect_size()
    {
        $this->beConstructedWith('sff');
        $this->shouldThrow('InvalidArgumentException')->duringInstantiation();
    }

    function it_is_default_when_xs()
    {
        $this->beConstructedWith(ScreenSize::EXTRA_SMALL);
        $this->isDefault()->shouldBe(true);
    }

    function it_is_not_default_when_sm()
    {
        $this->beConstructedWith(ScreenSize::SMALL);
        $this->isDefault()->shouldBe(false);
    }

    function it_is_not_default_when_md()
    {
        $this->beConstructedWith(ScreenSize::MEDIUM);
        $this->isDefault()->shouldBe(false);
    }

    function it_is_not_default_when_lg()
    {
        $this->beConstructedWith(ScreenSize::LARGE);
        $this->isDefault()->shouldBe(false);
    }

    function it_is_not_default_when_xl()
    {
        $this->beConstructedWith(ScreenSize::EXTRA_LARGE);
        $this->isDefault()->shouldBe(false);
    }

    function it_is_not_original_when_xs()
    {
        $this->beConstructedWith(ScreenSize::EXTRA_SMALL);
        $this->isOriginal()->shouldBe(false);
    }

    function it_is_not_original_when_sm()
    {
        $this->beConstructedWith(ScreenSize::SMALL);
        $this->isOriginal()->shouldBe(false);
    }

    function it_is_not_original_when_md()
    {
        $this->beConstructedWith(ScreenSize::MEDIUM);
        $this->isOriginal()->shouldBe(false);
    }

    function it_is_not_original_when_lg()
    {
        $this->beConstructedWith(ScreenSize::LARGE);
        $this->isOriginal()->shouldBe(false);
    }

    function it_is_original_when_xl()
    {
        $this->beConstructedWith(ScreenSize::EXTRA_LARGE);
        $this->isOriginal()->shouldBe(true);
    }

    function it_returns_empty_string_when_filename_is_null()
    {
        $this->beConstructedWith(ScreenSize::EXTRA_LARGE);
        $this->getResponsiveFilename(null)->shouldBeString();
        $this->getResponsiveFilename(null)->shouldBe('');
    }

    function it_returns_original_filename_when_is_original()
    {
        $this->beConstructedWith(ScreenSize::EXTRA_LARGE);
        $this->getResponsiveFilename('/this/is/my/path.jpg')->shouldBe('/this/is/my/path.jpg');
    }

    function it_returns_new_filename_xs()
    {
        $this->beConstructedWith(ScreenSize::EXTRA_SMALL);
        $this->getResponsiveFilename('/this/is/my/path.jpg')->shouldBe('/this/is/my/path--xs.jpg');
    }

    function it_returns_new_filename_sm()
    {
        $this->beConstructedWith(ScreenSize::SMALL);
        $this->getResponsiveFilename('/this/is/my/path.jpg')->shouldBe('/this/is/my/path--sm.jpg');
    }

    function it_returns_new_filename_md()
    {
        $this->beConstructedWith(ScreenSize::MEDIUM);
        $this->getResponsiveFilename('/this/is/my/path.jpg')->shouldBe('/this/is/my/path--md.jpg');
    }

    function it_returns_new_filename_lg()
    {
        $this->beConstructedWith(ScreenSize::LARGE);
        $this->getResponsiveFilename('/this/is/my/path.jpg')->shouldBe('/this/is/my/path--lg.jpg');
    }

    function it_returns_same_filename_xl()
    {
        $this->beConstructedWith(ScreenSize::EXTRA_LARGE);
        $this->getResponsiveFilename('/this/is/my/path.jpg')->shouldBe('/this/is/my/path.jpg');
    }

    function it_returns_correct_media_queries_xs()
    {
        $this->beConstructedWith(ScreenSize::EXTRA_SMALL);
        $this->__toString()->shouldBe('max-width: 575px');
    }

    function it_returns_correct_media_queries_sm()
    {
        $this->beConstructedWith(ScreenSize::SMALL);
        $this->__toString()->shouldBe('min-width: 576px');
    }

    function it_returns_correct_media_queries_md()
    {
        $this->beConstructedWith(ScreenSize::MEDIUM);
        $this->__toString()->shouldBe('min-width: 768px');
    }

    function it_returns_correct_media_queries_lg()
    {
        $this->beConstructedWith(ScreenSize::LARGE);
        $this->__toString()->shouldBe('min-width: 992px');
    }

    function it_returns_correct_media_queries_xl()
    {
        $this->beConstructedWith(ScreenSize::EXTRA_LARGE);
        $this->__toString()->shouldBe('min-width: 1200px');
    }
}
