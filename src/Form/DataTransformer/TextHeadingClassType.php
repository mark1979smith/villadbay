<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 16/01/2018
 * Time: 11:26
 */

namespace App\Form\DataTransformer;

use App\Entity\Page\TextHeading;
use Symfony\Component\Form\DataTransformerInterface;

class TextHeadingClassType implements DataTransformerInterface
{
    /**
     * @param TextHeading\CssClass|null $value
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
     * @return TextHeading\CssClass
     */
    public function reverseTransform($value)
    {
        return (new TextHeading\CssClass())->setValue($value);
    }
}