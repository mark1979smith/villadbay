<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/02/2018
 * Time: 13:14
 */

namespace App\Form\DataTransformer;

use App\Entity\Page\TextHeading;
use Symfony\Component\Form\DataTransformerInterface;

class TextHeadingColourType implements DataTransformerInterface
{
    /**
     * @param TextHeading\SizeClass|null $value
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
     * @return TextHeading\ColourClass
     */
    public function reverseTransform($value)
    {
        return (new TextHeading\ColourClass())->setValue($value);
    }
}
