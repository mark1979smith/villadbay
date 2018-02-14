<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/01/2018
 * Time: 19:46
 */

namespace App\Entity\Page;


use App\Entity\Page\TextHeading\SizeClass;
use App\Entity\Page\TextHeading\TextValue;
use App\Entity\Page\TextHeading\Type;

class TextHeading
{
    /** @var string  */
    private $template = "<div class=\"container\"><div class=\"row\"><div class=\"col\"><%s class=\"%s\">%s</%s></div></div></div>";

    /** @var null|\App\Entity\Page\TextHeading\Type;  */
    private $type;

    /** @var null|\App\Entity\Page\TextHeading\SizeClass  */
    private $sizeClass;

    /** @var null|\App\Entity\Page\TextHeading\ColourClass */
    private $colourClass;

    /** @var null|\App\Entity\Page\TextHeading\TextValue */
    private $textValue;

    public function __toString()
    {
        $cssClass = '';
        if ($this->getSizeClass()->getValue()) {
            $cssClass .= ' ' . $this->getSizeClass()->getValue();
        }

        if ($this->getColourClass()->getValue()) {
            $cssClass .= ' ' . $this->getColourClass()->getValue();
        }

        return sprintf(
            $this->getTemplate(),
            $this->getType()->getValue(),
            $cssClass,
            $this->getTextValue()->getValue(),
            $this->getType()->getValue()
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
     * @return \App\Entity\Page\TextHeading\SizeClass|null
     */
    public function getSizeClass(): ?SizeClass
    {
        return $this->sizeClass;
    }

    /**
     * @param \App\Entity\Page\TextHeading\SizeClass $cssClass
     *
     * @return TextHeading
     */
    public function setSizeClass(SizeClass $cssClass): TextHeading
    {
        $this->sizeClass = $cssClass;

        return $this;
    }

    /**
     * @return \App\Entity\Page\TextHeading\ColourClass|null
     */
    public function getColourClass(): ?\App\Entity\Page\TextHeading\ColourClass
    {
        return $this->colourClass;
    }

    /**
     * @param \App\Entity\Page\TextHeading\ColourClass|null $colourClass
     *
     * @return TextHeading
     */
    public function setColourClass(?\App\Entity\Page\TextHeading\ColourClass $colourClass): TextHeading
    {
        $this->colourClass = $colourClass;

        return $this;
    }

    /**
     * @return \App\Entity\Page\TextHeading\TextValue|null
     */
    public function getTextValue(): ?TextValue
    {
        return $this->textValue;
    }

    /**
     * @param \App\Entity\Page\TextHeading\TextValue $textValue
     *
     * @return TextHeading
     */
    public function setTextValue(TextValue $textValue): TextHeading
    {
        $this->textValue = $textValue;

        return $this;
    }

    /**
     * @return \App\Entity\Page\TextHeading\Type
     */
    public function getType(): ?Type
    {
        return $this->type;
    }

    /**
     * @param \App\Entity\Page\TextHeading\Type $type
     *
     * @return TextHeading
     */
    public function setType(Type $type): TextHeading
    {
        $this->type = $type;

        return $this;
    }




}
