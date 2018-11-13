<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/01/2018
 * Time: 20:30
 */

namespace App\Component\Page;

/**
 * Class ImageSet
 *
 * @package App\Component\Page
 */
class ImageSet
{
    /** @var null|string */
    private $media;

    /** @var string */
    private $src;

    /** @var string */
    private $alt;

    public function getMedia(): ?string
    {
        return $this->media;
    }

    public function setMedia(?string $media): self
    {
        $this->media = $media;

        return $this;
    }

    public function getSrc(): string
    {
        return $this->src;
    }

    public function setSrc(string $src): self
    {
        $this->src = $src;

        return $this;
    }

    public function getAlt(): string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }


}
