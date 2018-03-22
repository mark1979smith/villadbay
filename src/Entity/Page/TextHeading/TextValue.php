<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 16/01/2018
 * Time: 11:40
 */

namespace App\Entity\Page\TextHeading;

use Symfony\Component\Validator\Constraints as Assert;

class TextValue
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
     * @return TextValue
     */
    public function setValue(?string $value): TextValue
    {
        $this->value = $value;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->value;
    }

}
