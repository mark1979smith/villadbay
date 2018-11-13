<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 01/07/2018
 * Time: 20:58
 */

namespace App\Component\CarouselSlides;

use Symfony\Component\Validator\Constraints as Assert;


class Image
{
    /**
     * @Assert\NotBlank()
     *
     * @var null|string
     */
    private $value;

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->value;
    }


}
