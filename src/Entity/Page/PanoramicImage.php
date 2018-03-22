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
    private $template = "<div class=\"container-fluid\"><div class=\"row\"><div class=\"col img-fluid\" id=\"pano\" style=\"background-repeat: no-repeat; height: 320px; background-size: cover; background-position:center; background-image: url('https://d3orc742w48r4f.cloudfront.net/images/pano/%s');\"></div></div></div>";

    private $inlineStyleTemplate = '#pano {
            background-image: url(\'https://d3orc742w48r4f.cloudfront.net/images/pano/%s\');
            height: 320px !important;
        }

        @media (max-width: 991px) {
            #pano {
                background-image: url(\'https://d3orc742w48r4f.cloudfront.net/images/pano/%s\');
                height: 381px !important;
            }
        }

        @media (max-width: 767px) {
            #pano {
                background-image: url(\'https://d3orc742w48r4f.cloudfront.net/images/pano/%s\');
                height: 307px !important;
            }
        }

        @media (max-width: 576px) {
            #pano {
                background-image: url(\'https://d3orc742w48r4f.cloudfront.net/images/pano/%s\');
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
            str_replace('.', '--lg.', $this->getPanoramicImage()),
            str_replace('.', '--md.', $this->getPanoramicImage()),
            str_replace('.', '--sm.', $this->getPanoramicImage()),
            str_replace('.', '--xs.', $this->getPanoramicImage())
        );
    }
}
