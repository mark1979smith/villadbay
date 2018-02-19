<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 19/02/2018
 * Time: 19:41
 */

namespace App\Entity\Page;

use Symfony\Component\Validator\Constraints as Assert;

class Carousel
{
    /**
     * @Assert\NotBlank()
     * @var string
     */
    private $value;

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return Form
     */
    public function setValue(string $value): Carousel
    {
        $this->value = $value;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->value;
    }
}
