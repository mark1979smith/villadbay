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

class TextHeadingSizeType implements DataTransformerInterface
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
     * @return TextHeading\SizeClass
     */
    public function reverseTransform($value)
    {
        return (new TextHeading\SizeClass())->setValue($value);
    }
}
