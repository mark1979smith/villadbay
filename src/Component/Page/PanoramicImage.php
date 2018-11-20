<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 23/01/2018
 * Time: 13:09
 */

namespace App\Component\Page;


use App\Component\Helpers\ScreenSize;

/**
 * Class PanoramicImage
 *
 * @package App\Component\Page
 */
class PanoramicImage
{
    use InlineStyleResponsive, TemplateSetter;

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

    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * If size is defined the filename is amended to suit.
     */
    public function getPanoramicImage(ScreenSize $size): string
    {
        return $size->getResponsiveFilename($this->panoramicImage);
    }

    public function setPanoramicImage(?string $panoramicImage): self
    {
        $this->panoramicImage = $panoramicImage;

        return $this;
    }

    private function getInlineStyleResponsiveTemplate(?ScreenSize $size): string
    {
        if (is_null($size)) {
            return '#pano {
                background-repeat: no-repeat; 
                background-size: cover; 
                background-position:center;
            }' . PHP_EOL . PHP_EOL;
        } else {
            return '@media (' . $size->__toString() . ') {
            #pano {
                background-image: url(\'{{ cdn_url("'. $this->getPanoramicImage($size) . '") }}\');
                height: ' . $this->getInlineHeight($size) . 'px;
            }
        }' . PHP_EOL . PHP_EOL;
        }
    }

    public function getInlineHeight(ScreenSize $screenSize): string
    {
        switch ($screenSize->getSize()) {
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
