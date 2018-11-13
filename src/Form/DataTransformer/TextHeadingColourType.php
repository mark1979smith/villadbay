<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/02/2018
 * Time: 13:14
 */

namespace App\Form\DataTransformer;

use App\Component\Page\TextHeading\ColourClass;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class TextHeadingColourType
 *
 * @package App\Form\DataTransformer
 */
class TextHeadingColourType implements DataTransformerInterface
{
    public function transform($value): string
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return $value->getValue();
    }

    public function reverseTransform($value): ColourClass
    {
        return (new ColourClass())->setValue($value);
    }
}
