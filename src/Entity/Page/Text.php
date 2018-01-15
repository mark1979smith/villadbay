<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/01/2018
 * Time: 20:08
 */

namespace App\Entity\Page;


class Text
{
    /** @var string  */
    private $template = '<p>%s</p>';

    /** @var string */
    private $textValue;

    public function __toString()
    {
        return sprintf(
            $this->getTemplate(),
            $this->getTextValue()
        );
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $template
     *
     * @return Text
     */
    public function setTemplate(string $template): Text
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return string
     */
    public function getTextValue(): string
    {
        return $this->textValue;
    }

    /**
     * @param mixed $textValue
     *
     * @return Text
     */
    public function setTextValue($textValue): Text
    {
        $this->textValue = $textValue;

        return $this;
    }

}

