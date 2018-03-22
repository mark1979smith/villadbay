<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 18/01/2018
 * Time: 19:06
 */

namespace App\Form\DataTransformer;


use Symfony\Component\Form\DataTransformerInterface;

class ParagraphText implements DataTransformerInterface
{
    /**
     * @param \App\Entity\Page\ParagraphText|string|null $value
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
     * @return \App\Entity\Page\ParagraphText
     */
    public function reverseTransform($value)
    {
        return (new \App\Entity\Page\ParagraphText())->setTextValue($value);
    }
}
