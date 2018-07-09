<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 01/07/2018
 * Time: 20:58
 */

namespace App\Entity\CarouselSlides;

use Symfony\Component\Validator\Constraints as Assert;

class Description
{
    /**
     * @Assert\NotBlank()
     *
     * @var null|string
     */
    private $value;

    /**
     * @return null|string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param null|string $value
     *
     * @return \App\Entity\CarouselSlides\Description
     */
    public function setValue(?string $value): Description
    {
        $this->value = $value;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->value;
    }


}
