<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 23/01/2018
 * Time: 13:09
 */

namespace App\Entity\Page;


class PanoramicImage
{
    /** @var string  */
    private $template = "<div class=\"container-fluid\"><div class=\"row\"><div class=\"col img-fluid\" style=\"background-repeat: no-repeat; height: 320px; background-size: cover; background-position:center; background-image: url('https://d3orc742w48r4f.cloudfront.net/images/pano/%s');\"></div></div></div>";

    public function __toString()
    {
        return sprintf(
            $this->getTemplate(),
            $this->getPanoramicImage()
        );
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
     * @return TextHeading
     */
    public function setTemplate(string $template): TextHeading
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPanoramicImage(): ?string
    {
        return $this->panoramicImage;
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
}
