<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/02/2018
 * Time: 14:22
 */

namespace App\Entity\Page\TextHeading;

use Symfony\Component\Validator\Constraints as Assert;


class AlignClass
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
     * @return AlignClass
     */
    public function setValue(?string $value): AlignClass
    {
        $this->value = $value;

        return $this;
    }
}
