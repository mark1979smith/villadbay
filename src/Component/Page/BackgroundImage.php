<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 07/02/2018
 * Time: 11:57
 */

namespace App\Component\Page;


use App\Utils\Helpers\ScreenSize;

/**
 * Class BackgroundImage
 *
 * @package App\Component\Page
 */
class BackgroundImage
{
    use InlineStyleResponsive;

    private $backgroundImage;

    /**
     * If size is defined the filename is amended to suit.
     *
     * @param \App\Utils\Helpers\ScreenSize $size
     *
     * @return mixed
     */
    public function getBackgroundImage(ScreenSize $size): string
    {
        return $size->getResponsiveFilename($this->backgroundImage);
    }

    public function setBackgroundImage($backgroundImage): self
    {
        $this->backgroundImage = $backgroundImage;

        return $this;
    }

    private function getInlineStyleResponsiveTemplate(?ScreenSize $size): string
    {
        if (is_null($size)) {
            return 'body {
                background-repeat: no-repeat;
                background-position: center center;
                background-attachment: fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                background-size: cover;
                -o-background-size: cover;
            }' . PHP_EOL . PHP_EOL;
        } else {
            return '@media (' . $size->__toString() . ') {
                body {
                    background-image: url(\'{{ cdn_url("'. $this->getBackgroundImage($size) . '") }}\');
                }
            }' . PHP_EOL . PHP_EOL;
        }
    }

}
