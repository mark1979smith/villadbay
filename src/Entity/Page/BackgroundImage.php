<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 07/02/2018
 * Time: 11:57
 */

namespace App\Entity\Page;


use App\Utils\Helpers\ScreenSize;

class BackgroundImage
{
    private $backgroundImage;

    public function __toStyles()
    {
        return $this->getInlineStyleResponsiveTemplate(new ScreenSize(ScreenSize::EXTRA_SMALL)) .
            $this->getInlineStyleResponsiveTemplate(new ScreenSize(ScreenSize::EXTRA_LARGE)) .
            $this->getInlineStyleResponsiveTemplate(new ScreenSize(ScreenSize::LARGE)) .
            $this->getInlineStyleResponsiveTemplate(new ScreenSize(ScreenSize::MEDIUM)) .
            $this->getInlineStyleResponsiveTemplate(new ScreenSize(ScreenSize::SMALL));
    }

    /**
     * If size is defined the filename is amended to suit.
     *
     * @param \App\Utils\Helpers\ScreenSize $size
     *
     * @return mixed
     */
    public function getBackgroundImage(ScreenSize $size)
    {
        return $size->getResponsiveFilename($this->backgroundImage);
    }

    /**
     * @param mixed $backgroundImage
     *
     * @return BackgroundImage
     */
    public function setBackgroundImage($backgroundImage)
    {
        $this->backgroundImage = $backgroundImage;

        return $this;
    }

    private function getInlineStyleResponsiveTemplate(ScreenSize $size)
    {
        if ($size->isDefault()) {
            return 'body {
                background-image: url(\'' . $this->getBackgroundImage($size) . '\');
                background-repeat: no-repeat;
                background-position: center center;
                background-attachment: fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                background-size: cover;
                -o-background-size: cover;
            }' . PHP_EOL . PHP_EOL;
        } else {
            return '@media (min-width: ' . ScreenSize::$minWidth[$size->__toString()] . 'px) {
            body {
                background-image: url(\'' . $this->getBackgroundImage($size) . '\');
            }
        }' . PHP_EOL . PHP_EOL;
        }
    }

}
