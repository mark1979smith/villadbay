<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 16/01/2018
 * Time: 10:03
 */

namespace App\Form\DataTransformer;

use App\Component\Page\TextHeading\Type;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class TextHeadingType
 *
 * @package App\Form\DataTransformer
 */
class TextHeadingType implements DataTransformerInterface
{
    public function transform($value): string
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return $value->getValue();
    }

    public function reverseTransform($value): Type
    {
        return (new Type())->setValue($value);
    }
}
