<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 16/01/2018
 * Time: 11:26
 */

namespace App\Form\DataTransformer;

use App\Component\Page\TextHeading\SizeClass;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class TextHeadingSizeType
 *
 * @package App\Form\DataTransformer
 */
class TextHeadingSizeType implements DataTransformerInterface
{
    public function transform($value): string
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return (string) $value->getValue();
    }

    public function reverseTransform($value): SizeClass
    {
        return (new SizeClass())->setValue($value);
    }
}
