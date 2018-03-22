<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/01/2018
 * Time: 20:30
 */

namespace App\Entity\Page;


class ImageSet
{
    /** @var null|string */
    private $media;

    /** @var string */
    private $src;

    /** @var string */
    private $alt;

    /**
     * @return null|string
     */
    public function getMedia(): ?string
    {
        return $this->media;
    }

    /**
     * @param null|string $media
     *
     * @return ImageSet
     */
    public function setMedia(?string $media): ImageSet
    {
        $this->media = $media;

        return $this;
    }

    /**
     * @return string
     */
    public function getSrc(): string
    {
        return $this->src;
    }

    /**
     * @param string $src
     *
     * @return ImageSet
     */
    public function setSrc(string $src): ImageSet
    {
        $this->src = $src;

        return $this;
    }

    /**
     * @return string
     */
    public function getAlt(): string
    {
        return $this->alt;
    }

    /**
     * @param string $alt
     *
     * @return ImageSet
     */
    public function setAlt(string $alt): ImageSet
    {
        $this->alt = $alt;

        return $this;
    }


}
