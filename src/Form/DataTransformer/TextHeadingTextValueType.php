<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 16/01/2018
 * Time: 16:22
 */

namespace App\Form\DataTransformer;


use App\Entity\Page\TextHeading;
use Symfony\Component\Form\DataTransformerInterface;

class TextHeadingTextValueType implements DataTransformerInterface
{
    /**
     * @param TextHeading\TextValue|null $value
     *
     * @return string
     */
    public function transform($value)
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return $value->getValue();
    }

    /**
     * @param string $value
     *
     * @return TextHeading\TextValue
     */
    public function reverseTransform($value)
    {
        return (new TextHeading\TextValue())->setValue($value);
    }
}
