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
    private $template = "<div class=\"container-fluid\"><div class=\"row\"><div class=\"col img-fluid\" id=\"pano\" style=\"background-repeat: no-repeat; height: 320px; background-size: cover; background-position:center; background-image: url('%s');\"></div></div></div>";

    private $inlineStyleTemplate = '#pano {
            background-image: url(\'%s\');
            height: 320px !important;
        }

        @media (max-width: 991px) {
            #pano {
                background-image: url(\'%s\');
                height: 381px !important;
            }
        }

        @media (max-width: 767px) {
            #pano {
                background-image: url(\'%s\');
                height: 307px !important;
            }
        }

        @media (max-width: 576px) {
            #pano {
                background-image: url(\'%s\');
                height: 230px !important;
            }
        }';

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
     * If size is defined the filename is amended to suit.
     *
     * @param null|string $size
     *
     * @return null|string
     */
    public function getPanoramicImage($size = null): ?string
    {
        if (!is_null($size)) {
            // Find last occurence of '.' and prepend with '--$size'
            return substr_replace($this->panoramicImage, '--' . $size, strrpos($this->panoramicImage, '.'), 0);
        }
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

    /**
     * @return string
     */
    public function getInlineStyleTemplate(): string
    {
        return $this->inlineStyleTemplate;
    }

    /**
     * @param string $inlineStyleTemplate
     *
     * @return BackgroundImage
     */
    public function setInlineStyleTemplate(string $inlineStyleTemplate): BackgroundImage
    {
        $this->inlineStyleTemplate = $inlineStyleTemplate;

        return $this;
    }

    public function __toStyles()
    {
        return sprintf(
            $this->getInlineStyleTemplate(),
            $this->getPanoramicImage(),
            $this->getPanoramicImage('lg'),
            $this->getPanoramicImage('md'),
            $this->getPanoramicImage('sm'),
            $this->getPanoramicImage('xs')
        );
    }
}
