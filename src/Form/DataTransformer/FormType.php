<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 16/02/2018
 * Time: 13:11
 */

namespace App\Form\DataTransformer;


use Symfony\Component\Form\DataTransformerInterface;

class FormType implements DataTransformerInterface
{
    /**
     * @param string $value
     *
     * @return string
     */
    public function transform($value)
    {
        return (new \App\Entity\Page\Form())->setFormType($value);

    }

    /**
     * @param \App\Entity\Page\Form $value
     *
     * @return string
     */
    public function reverseTransform($value)
    {
        if (null === $value || is_string($value)) {
            return (string) $value;
        }

        return $value->getFormType();
    }
}
