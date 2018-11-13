<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/01/2018
 * Time: 19:46
 */

namespace App\Component\Page;


use App\Component\Page\TextHeading\SizeClass;
use App\Component\Page\TextHeading\TextValue;
use App\Component\Page\TextHeading\Type;
use App\Component\Page\TextHeading\ColourClass;
use App\Component\Page\TextHeading\AlignClass;

/**
 * Class TextHeading
 *
 * @package App\Component\Page
 */
class TextHeading
{
    /** @var string  */
    private $template = "<div class=\"container\"><div class=\"row\"><div class=\"col\"><%s class=\"%s\">%s<\/%s></div></div></div>";

    /** @var null|Type;  */
    private $type;

    /** @var null|SizeClass  */
    private $sizeClass;

    /** @var null|ColourClass */
    private $colourClass;

    /** @var null|AlignClass */
    private $alignClass;

    /** @var null|TextValue */
    private $textValue;

    public function __toString(): string
    {
        $cssClass = '';
        if ($this->getSizeClass()->getValue()) {
            $cssClass .= ' ' . $this->getSizeClass()->getValue();
        }

        if ($this->getColourClass()->getValue()) {
            $cssClass .= ' ' . $this->getColourClass()->getValue();
        }

        if ($this->getAlignClass()->getValue()) {
            $cssClass .= ' ' . $this->getAlignClass()->getValue();
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
    public function setTemplate(string $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function getSizeClass(): ?SizeClass
    {
        return $this->sizeClass;
    }

    public function setSizeClass(SizeClass $cssClass): self
    {
        $this->sizeClass = $cssClass;

        return $this;
    }

    public function getColourClass(): ?ColourClass
    {
        return $this->colourClass;
    }

    public function setColourClass(?ColourClass $colourClass): self
    {
        $this->colourClass = $colourClass;

        return $this;
    }

    public function getTextValue(): ?TextValue
    {
        return $this->textValue;
    }

    public function setTextValue(TextValue $textValue): self
    {
        $this->textValue = $textValue;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAlignClass(): ?AlignClass
    {
        return $this->alignClass;
    }

    public function setAlignClass(?AlignClass $alignClass): self
    {
        $this->alignClass = $alignClass;

        return $this;
    }
}
