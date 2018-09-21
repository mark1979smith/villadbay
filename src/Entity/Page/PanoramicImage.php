<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 23/01/2018
 * Time: 13:09
 */

namespace App\Entity\Page;


use App\Utils\Helpers\ScreenSize;

class PanoramicImage
{
    /** @var string */
    private $template = "<div class=\"container-fluid\"><div class=\"row\"><div class=\"col img-fluid\" id=\"pano\"></div></div></div>";

    public function __toString()
    {
        return $this->getTemplate();
    }

    /**
     * @var null|string
     */
    private $panoramicImage;

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $template
     *
     * @return \App\Entity\Page\PanoramicImage
     */
    public function setTemplate(string $template): \App\Entity\Page\PanoramicImage
    {
        $this->template = $template;

        return $this;
    }

    /**
     * If size is defined the filename is amended to suit.
     *
     * @param null|string $size
     *
     * @return null|string
     */
    public function getPanoramicImage(ScreenSize $size): string
    {
        return $size->getResponsiveFilename($this->panoramicImage);
    }

    /**
     * @param null|string $panoramicImage
     *
     * @return PanoramicImage
     */
    public function setPanoramicImage($panoramicImage): PanoramicImage
    {
        $this->panoramicImage = $panoramicImage;

        return $this;
    }

    public function __toStyles()
    {
        return $this->getInlineStyleResponsiveTemplate(new ScreenSize(ScreenSize::EXTRA_SMALL)) .
            $this->getInlineStyleResponsiveTemplate(new ScreenSize(ScreenSize::EXTRA_LARGE)) .
            $this->getInlineStyleResponsiveTemplate(new ScreenSize(ScreenSize::LARGE)) .
            $this->getInlineStyleResponsiveTemplate(new ScreenSize(ScreenSize::MEDIUM)) .
            $this->getInlineStyleResponsiveTemplate(new ScreenSize(ScreenSize::SMALL));
    }

    private function getInlineStyleResponsiveTemplate(ScreenSize $size): string
    {
        if ($size->isDefault()) {
            return '#pano {
                background-image: url(\'' . $this->getPanoramicImage($size) . '\');
                background-repeat: no-repeat; 
                background-size: cover; 
                background-position:center;
                height: ' . $this->getInlineHeight($size) . 'px;
            }' . PHP_EOL . PHP_EOL;
        } else {
            return '@media (min-width: ' . ScreenSize::$minWidth[$size->__toString()] . 'px) {
            #pano {
                background-image: url(\'' . $this->getPanoramicImage($size) . '\');
                height: ' . $this->getInlineHeight($size) . 'px;   
            }
        }' . PHP_EOL . PHP_EOL;
        }
    }

    private function getInlineHeight(ScreenSize $screenSize): string
    {
        switch ($screenSize->__toString()) {
            case $screenSize::EXTRA_SMALL:
            default:
                return '230';
                break;

            case $screenSize::SMALL:
                return '230';
                break;

            case $screenSize::MEDIUM:
                return '307';
                break;

            case $screenSize::LARGE:
                return '320';
                break;

            case $screenSize::EXTRA_LARGE:
                return '381';
                break;
        }
    }

}
