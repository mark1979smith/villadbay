<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/01/2018
 * Time: 20:26
 */

namespace App\Entity\Page;


class Carousel
{
    /** @var array Carousel */
    private $slides;

    /**
     * @return array
     */
    public function getSlides(): array
    {
        return $this->slides;
    }

    /**
     * @param array $slides
     *
     * @return Carousel
     */
    public function setSlides(array $slides): Carousel
    {
        $this->slides = $slides;

        return $this;
    }


}
