<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/01/2018
 * Time: 20:08
 */

namespace App\Entity\Page;


class ParagraphText
{
    /** @var string  */
    private $template = '<p>%s</p>';

    /** @var null|string */
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
     * @return ParagraphText
     */
    public function setTemplate(string $template): ParagraphText
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getTextValue(): ?string
    {
        return $this->textValue;
    }

    /**
     * @param mixed $textValue
     *
     * @return ParagraphText
     */
    public function setTextValue($textValue): ParagraphText
    {
        $this->textValue = $textValue;

        return $this;
    }

}

