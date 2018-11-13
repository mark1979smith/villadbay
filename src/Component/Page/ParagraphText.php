<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/01/2018
 * Time: 20:08
 */

namespace App\Component\Page;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ParagraphText
 *
 * @package App\Component\Page
 */
class ParagraphText
{
    /** @var string  */
    private $template = '<div class="container"><div class="row"><div class="col"><p>%s</p></div></div></div>';

    /**
     * @Assert\NotBlank()
     *
     * @var null|string
     */
    private $textValue;

    public function __toString(): string
    {
        return sprintf(
            $this->getTemplate(),
            $this->getTextValue()
        );
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function setTemplate(string $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function getTextValue(): ?string
    {
        return $this->textValue;
    }

    public function setTextValue($textValue): self
    {
        $this->textValue = $textValue;

        return $this;
    }

}

