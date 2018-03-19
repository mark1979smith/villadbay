<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 07/02/2018
 * Time: 11:57
 */

namespace App\Entity\Page;


class BackgroundImage
{
    private $inlineStyleTemplate = 'body {
        background-image: url(\'https://d3orc742w48r4f.cloudfront.net/images/backgrounds/%s\');
        background-repeat: no-repeat;
        background-position: center center;
        background-attachment: fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
        -o-background-size: cover;
    }
    
    @media (max-width: 1199px) {
        body {
            background-image: url(\'https://d3orc742w48r4f.cloudfront.net/images/backgrounds/%s\');
        }
    }

    @media (max-width: 991px) {
        body {
            background-image: url(\'https://d3orc742w48r4f.cloudfront.net/images/backgrounds/%s\');
        }
    }

    @media (max-width: 767px) {
        body {
            background-image: url(\'https://d3orc742w48r4f.cloudfront.net/images/backgrounds/%s\');
        }
    }

    @media (max-width: 575px) {
        body {
            background-image: url(\'https://d3orc742w48r4f.cloudfront.net/images/backgrounds/%s\');
        }
    }';


    private $backgroundImage;

    public function __toStyles()
    {
        return sprintf(
            $this->getInlineStyleTemplate(),
            $this->getBackgroundImage(),
            str_replace('.', '--lg.', $this->getBackgroundImage()),
            str_replace('.', '--md.', $this->getBackgroundImage()),
            str_replace('.', '--sm.', $this->getBackgroundImage()),
            str_replace('.', '--xs.', $this->getBackgroundImage())
        );
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

    /**
     * @return mixed
     */
    public function getBackgroundImage()
    {
        return $this->backgroundImage;
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



}
