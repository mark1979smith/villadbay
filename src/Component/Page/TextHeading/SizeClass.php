<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 16/01/2018
 * Time: 11:40
 */

namespace App\Component\Page\TextHeading;

use Symfony\Component\Validator\Constraints as Assert;

class SizeClass
{
    /** @var null|string */
    private $value;

    /**
     * @Assert\NotBlank()
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
