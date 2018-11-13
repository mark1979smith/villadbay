<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 16/01/2018
 * Time: 16:22
 */

namespace App\Form\DataTransformer;


use App\Component\Page\TextHeading\TextValue;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class TextHeadingTextValueType
 *
 * @package App\Form\DataTransformer
 */
class TextHeadingTextValueType implements DataTransformerInterface
{
    public function transform($value): string
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return $value->getValue();
    }

    public function reverseTransform($value): TextValue
    {
        return (new TextValue())->setValue($value);
    }
}
