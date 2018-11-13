<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/02/2018
 * Time: 14:22
 */

namespace App\Component\Page\TextHeading;

use Symfony\Component\Validator\Constraints as Assert;


class AlignClass
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
