<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/02/2018
 * Time: 13:15
 */

namespace App\Entity\Page\TextHeading;

use Symfony\Component\Validator\Constraints as Assert;

class ColourClass
{
    /** @var null|string */
    private $value;

    /**
     * @Assert\NotBlank()
     *
     * @return null|string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param null|string $value
     *
     * @return ColourClass
     */
    public function setValue(?string $value): ColourClass
    {
        $this->value = $value;

        return $this;
    }
}
