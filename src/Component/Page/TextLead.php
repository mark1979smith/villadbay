<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/01/2018
 * Time: 20:05
 */

namespace App\Component\Page;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class TextLead
 *
 * @package App\Component\Page
 */
class TextLead
{
    use TemplateSetter;

    /** @var string  */
    private $template = '<div class="container"><div class="row"><div class="col"><p class="lead">%s</p></div></div></div>';

    /**
     * @Assert\NotBlank()
     *
     * @var string
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
