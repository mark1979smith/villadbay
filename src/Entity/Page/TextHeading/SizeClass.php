<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 16/01/2018
 * Time: 11:40
 */

namespace App\Entity\Page\TextHeading;

use Symfony\Component\Validator\Constraints as Assert;

class SizeClass
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
     * @return SizeClass
     */
    public function setValue(?string $value): SizeClass
    {
        $this->value = $value;

        return $this;
    }
}