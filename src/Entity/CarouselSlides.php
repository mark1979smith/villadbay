<?php

namespace App\Entity;

use App\Entity\CarouselSlides\Image;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarouselSlidesRepository")
 */
class CarouselSlides
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CarouselContainer", inversedBy="carouselSlides")
     * @ORM\JoinColumn(nullable=false)
     */
    private $carousel_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /** @var int */
    private $position;

    public function getId()
    {
        return $this->id;
    }

    public function getCarouselId(): ?CarouselContainer
    {
        return $this->carousel_id;
    }

    public function setCarouselId(?CarouselContainer $carousel_id): self
    {
        $this->carousel_id = $carousel_id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * @param int $position
     *
     * @return CarouselSlides
     */
    public function setPosition(?int $position): CarouselSlides
    {
        $this->position = $position;

        return $this;
    }

    public function renderSlide($slideNumber)
    {
        $this->setPosition($slideNumber);
        return $this->__toString();
    }

    public function __toString()
    {
        $xlImage = $this->getImage();
        $lgImage = substr_replace($this->getImage(), '--lg', strrpos($this->getImage(), '.'), 0);
        $mdImage = substr_replace($this->getImage(), '--md', strrpos($this->getImage(), '.'), 0);
        $smImage = substr_replace($this->getImage(), '--sm', strrpos($this->getImage(), '.'), 0);
        $xsImage = substr_replace($this->getImage(), '--xs', strrpos($this->getImage(), '.'), 0);

        $carouselItemClass = ($this->getPosition() == '1' ? ' active' : '');
        $str = <<<SLIDE
            <div class="carousel-item{$carouselItemClass}">
                <picture>
                    <source media="(min-width: 1200px)" srcset="{{ cdn_url('{$xlImage}') }}">
                    <source media="(min-width: 992px)" srcset="{{ cdn_url('{$lgImage}') }}">
                    <source media="(min-width: 768px)" srcset="{{ cdn_url('{$mdImage}') }}">
                    <source media="(min-width: 576px)" srcset="{{ cdn_url('{$smImage}') }}">
                    <img class="d-block w-100" src="{{ cdn_url('{$xsImage}') }}" alt="First slide">
                </picture>
                <div class="carousel-caption d-none d-md-block">
                    <h3>{$this->getTitle()}</h3>
                    <p>{$this->getDescription()}</p>
                </div>
            </div>
SLIDE;

        return $str;
    }

}
