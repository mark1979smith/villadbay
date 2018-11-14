<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/02/2018
 * Time: 14:30
 */

namespace App\Form\DataTransformer;

use App\Component\Page\TextHeading\AlignClass;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class TextHeadingAlignType
 *
 * @package App\Form\DataTransformer
 */
class TextHeadingAlignType implements DataTransformerInterface
{
    public function transform($value): string
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return (string) $value->getValue();
    }

    public function reverseTransform($value): AlignClass
    {
        return (new AlignClass())->setValue($value);
    }
}
