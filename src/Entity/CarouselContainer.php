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
    private $template = '<div class="container"><div class="row"><div class="col"><div id="carouselVillaIndicators" class="carousel slide" data-ride="carousel"><ol class="carousel-indicators">%s</ol><div class="carousel-inner">%s</div><a class="carousel-control-prev" href="#carouselVillaIndicators" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carouselVillaIndicators" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a></div></div></div></div>';

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
     * @ORM\OneToMany(targetEntity="App\Entity\CarouselSlides", mappedBy="carousel_id", orphanRemoval=true,
     *                                                          fetch="EAGER")
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

    public function __toString()
    {
        return sprintf($this->template,
            $this->renderIndicators(),
            $this->renderCarouselSlides()
        );
    }

    private function renderIndicators()
    {
        $str = '';
        foreach ($this->getCarouselSlides()->getValues() as $index => $carouselSlide) {
            $str .= '<li data-target="#carouselVillaIndicators" data-slide-to="$index" class="active"></li>';
        }

        return $str;
    }

    private function renderCarouselSlides()
    {
        $allSlides = $this->getCarouselSlides()->getValues();
        $firstSlide  = array_shift($allSlides);
        return $firstSlide->setPosition(1)->__toString() . implode('', $allSlides);
    }
}
