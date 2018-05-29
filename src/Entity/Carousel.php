<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarouselRepository")
 */
class Carousel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="App\Entity\CarouselEntries", mappedBy="carousel", orphanRemoval=true)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    public function __construct()
    {
        $this->carousel = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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
     * @return Collection|CarouselEntries[]
     */
    public function getCarousel(): Collection
    {
        return $this->carousel;
    }

    public function addCarousel(CarouselEntries $carousel): self
    {
        if (!$this->carousel->contains($carousel)) {
            $this->carousel[] = $carousel;
            $carousel->setCarousel($this);
        }

        return $this;
    }

    public function removeCarouselId(CarouselEntries $carousel): self
    {
        if ($this->carousel->contains($carousel)) {
            $this->carousel->removeElement($carousel);
            // set the owning side to null (unless already changed)
            if ($carousel->getCarousel() === $this) {
                $carousel->setCarousel(null);
            }
        }

        return $this;
    }
}
