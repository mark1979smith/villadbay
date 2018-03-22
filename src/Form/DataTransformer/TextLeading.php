<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 18/01/2018
 * Time: 12:17
 */

namespace App\Form\DataTransformer;


use Symfony\Component\Form\DataTransformerInterface;

class TextLeading implements DataTransformerInterface
{
    /**
     * @param \App\Entity\Page\TextLead|string|null $value
     *
     * @return string
     */
    public function transform($value)
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return $value->getTextValue();
    }

    /**
     * @param string $value
     *
     * @return \App\Entity\Page\TextLead
     */
    public function reverseTransform($value)
    {
        return (new \App\Entity\Page\TextLead())->setTextValue($value);
    }
}
