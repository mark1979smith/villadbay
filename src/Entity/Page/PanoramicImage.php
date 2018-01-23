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
     * @var string
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
     * @param string $panoramicImage
     *
     * @return PageType
     */
    public function setPanoramicImage(string $panoramicImage): PageType
    {
        $this->panoramicImage = $panoramicImage;

        return $this;
    }
}
