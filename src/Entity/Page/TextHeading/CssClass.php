<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 16/01/2018
 * Time: 11:40
 */

namespace App\Entity\Page\TextHeading;


class CssClass
{
    /** @var null|string */
    private $value;

    /**
     * @return null|string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return CssClass
     */
    public function setValue(string $value): CssClass
    {
        $this->value = $value;

        return $this;
    }
}
