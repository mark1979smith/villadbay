<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 16/01/2018
 * Time: 11:40
 */

namespace App\Entity\Page\TextHeading;


class Type
{
    /** @var null|string */
    private $value;

    /**
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return Type
     */
    public function setValue(string $value): Type
    {
        $this->value = $value;

        return $this;
    }
}
