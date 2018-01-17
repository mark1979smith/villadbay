<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 16/01/2018
 * Time: 10:03
 */

namespace App\Form\DataTransformer;

use App\Entity\Page\TextHeading;
use Symfony\Component\Form\DataTransformerInterface;

class TextHeadingType implements DataTransformerInterface
{
    /**
     * @param TextHeading\Type|null $value
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
     * @return TextHeading\Type
     */
    public function reverseTransform($value)
    {
        return (new TextHeading\Type())->setValue($value);
    }
}