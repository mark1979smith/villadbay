<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 23/09/2018
 * Time: 14:23
 */

namespace App\Component\Page;


use App\Component\Helpers\ScreenSize;

/**
 * Trait InlineStyleResponsive
 *
 * @package App\Component\Page
 */
trait InlineStyleResponsive
{
    public function __toStyles()
    {
        return
            $this->getInlineStyleResponsiveTemplate(null) .
            $this->getInlineStyleResponsiveTemplate(new ScreenSize(ScreenSize::EXTRA_SMALL)) .
            $this->getInlineStyleResponsiveTemplate(new ScreenSize(ScreenSize::SMALL)) .
            $this->getInlineStyleResponsiveTemplate(new ScreenSize(ScreenSize::MEDIUM)) .
            $this->getInlineStyleResponsiveTemplate(new ScreenSize(ScreenSize::LARGE)) .
            $this->getInlineStyleResponsiveTemplate(new ScreenSize(ScreenSize::EXTRA_LARGE));
    }
}
