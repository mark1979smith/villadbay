<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/02/2018
 * Time: 14:30
 */

namespace App\Form\DataTransformer;

use App\Entity\Page\TextHeading;

use Symfony\Component\Form\DataTransformerInterface;

class TextHeadingAlignType implements DataTransformerInterface
{
    /**
     * @param TextHeading\AlignClass|null $value
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
     * @return TextHeading\AlignClass
     */
    public function reverseTransform($value)
    {
        return (new TextHeading\AlignClass())->setValue($value);
    }
}
