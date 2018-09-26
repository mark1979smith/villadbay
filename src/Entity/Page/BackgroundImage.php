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
        background-image: url(\'%s\');
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
            background-image: url(\'%s\');
        }
    }

    @media (max-width: 991px) {
        body {
            background-image: url(\'%s\');
        }
    }

    @media (max-width: 767px) {
        body {
            background-image: url(\'%s\');
        }
    }

    @media (max-width: 575px) {
        body {
            background-image: url(\'%s\');
        }
    }';


    private $backgroundImage;

    public function __toStyles()
    {
        return sprintf(
            $this->getInlineStyleTemplate(),
            $this->getBackgroundImage(),
            $this->getBackgroundImage('lg'),
            $this->getBackgroundImage('md'),
            $this->getBackgroundImage('sm'),
            $this->getBackgroundImage('xs')
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
     * If size is defined the filename is amended to suit.
     *
     * @param null|string $size
     *
     * @return mixed
     */
    public function getBackgroundImage($size = null)
    {
        if (!is_null($size)) {
            // Find last occurence of '.' and prepend with '--$size'
            return substr_replace($this->backgroundImage, '--' . $size, strrpos($this->backgroundImage, '.'), 0);
        }
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
