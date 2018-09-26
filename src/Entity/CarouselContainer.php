<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarouselContainerRepository")
 */
class CarouselContainer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CarouselSlides", mappedBy="carousel_id", orphanRemoval=true)
     */
    private $carouselSlides;

    public function __construct()
    {
        $this->carouselSlides = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|CarouselSlides[]
     */
    public function getCarouselSlides(): Collection
    {
        return $this->carouselSlides;
    }

    public function addCarouselSlide(CarouselSlides $carouselSlide): self
    {
        if (!$this->carouselSlides->contains($carouselSlide)) {
            $this->carouselSlides[] = $carouselSlide;
            $carouselSlide->setCarouselId($this);
        }

        return $this;
    }

    public function removeCarouselSlide(CarouselSlides $carouselSlide): self
    {
        if ($this->carouselSlides->contains($carouselSlide)) {
            $this->carouselSlides->removeElement($carouselSlide);
            // set the owning side to null (unless already changed)
            if ($carouselSlide->getCarouselId() === $this) {
                $carouselSlide->setCarouselId(null);
            }
        }

        return $this;
    }
}
