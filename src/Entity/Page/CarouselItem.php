<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/01/2018
 * Time: 20:26
 */

namespace App\Entity\Page;


class CarouselItem
{
    /** @var array ImageSet */
    private $imageSrc;

    /** @var null|string */
    private $heading;

    /** @var null|string */
    private $text;

    /** @var int */
    private $displayOrder;

    /**
     * @return array
     */
    public function getImageSrc(): array
    {
        return $this->imageSrc;
    }

    /**
     * @param array $imageSrc
     *
     * @return CarouselItem
     */
    public function setImageSrc(array $imageSrc): CarouselItem
    {
        $this->imageSrc = $imageSrc;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getHeading(): ?string
    {
        return $this->heading;
    }

    /**
     * @param null|string $heading
     *
     * @return CarouselItem
     */
    public function setHeading(?string $heading): CarouselItem
    {
        $this->heading = $heading;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param null|string $text
     *
     * @return CarouselItem
     */
    public function setText(?string $text): CarouselItem
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return int
     */
    public function getDisplayOrder(): int
    {
        return $this->displayOrder;
    }

    /**
     * @param int $displayOrder
     *
     * @return CarouselItem
     */
    public function setDisplayOrder(int $displayOrder): CarouselItem
    {
        $this->displayOrder = $displayOrder;

        return $this;
    }



}
