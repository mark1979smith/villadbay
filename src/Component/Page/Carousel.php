<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 19/02/2018
 * Time: 19:41
 */

namespace App\Component\Page;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Carousel
 *
 * @package App\Component\Page
 */
class Carousel
{
    /**
     * @Assert\NotBlank()
     */
    private $value;

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
