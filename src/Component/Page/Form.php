<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 16/02/2018
 * Time: 13:07
 */

namespace App\Component\Page;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Form
 *
 * @package App\Component\Page
 */
class Form
{
    /**
     * @Assert\NotBlank()
     * @var string
     */
    private $formType;

    public function getFormType(): string
    {
        return $this->formType;
    }

    public function setFormType(string $formType): self
    {
        $this->formType = $formType;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->formType;
    }
}
