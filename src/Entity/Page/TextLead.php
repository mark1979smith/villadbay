<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/01/2018
 * Time: 20:05
 */

namespace App\Entity\Page;

use Symfony\Component\Validator\Constraints as Assert;

class TextLead
{
    /** @var string  */
    private $template = '<p class="lead">%s</p>';

    /**
     * @Assert\NotBlank()
     *
     * @var string
     */
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
     * @return TextLead
     */
    public function setTemplate(string $template): TextLead
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
     * @return TextLead
     */
    public function setTextValue($textValue): TextLead
    {
        $this->textValue = $textValue;

        return $this;
    }

}
