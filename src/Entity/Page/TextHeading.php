<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/01/2018
 * Time: 19:46
 */

namespace App\Entity\Page;


class TextHeading
{
    /** @var string  */
    private $template = '<%s class="%s">%s</%s>';

    /** @var string  */
    private $type = 'h1';

    /** @var string  */
    private $cssClass = 'display-h3';

    /** @var string */
    private $textValue;

    public function __toString()
    {
        return sprintf(
            $this->getTemplate(),
            $this->getType(),
            $this->getCssClass(),
            $this->getTextValue(),
            $this->getType()
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
     * @return TextHeading
     */
    public function setTemplate(string $template): TextHeading
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return string
     */
    public function getCssClass(): string
    {
        return $this->cssClass;
    }

    /**
     * @param mixed $cssClass
     *
     * @return TextHeading
     */
    public function setCssClass($cssClass): TextHeading
    {
        $this->cssClass = $cssClass;

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
     * @return TextHeading
     */
    public function setTextValue($textValue): TextHeading
    {
        $this->textValue = $textValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return TextHeading
     */
    public function setType($type): TextHeading
    {
        $this->type = $type;

        return $this;
    }




}
