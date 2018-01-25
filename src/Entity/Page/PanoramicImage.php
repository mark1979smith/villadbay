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
    /**
     * @var null|string
     */
    private $panoramicImage;

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
