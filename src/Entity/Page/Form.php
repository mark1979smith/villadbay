<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 16/02/2018
 * Time: 13:07
 */

namespace App\Entity\Page;

use Symfony\Component\Validator\Constraints as Assert;


class Form
{
    /**
     * @Assert\NotBlank()
     * @var string
     */
    private $formType;

    /**
     * @return string
     */
    public function getFormType(): string
    {
        return $this->formType;
    }

    /**
     * @param string $formType
     *
     * @return Form
     */
    public function setFormType(string $formType): Form
    {
        $this->formType = $formType;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->formType;
    }
}
