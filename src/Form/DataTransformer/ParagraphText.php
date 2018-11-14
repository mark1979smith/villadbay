<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 18/01/2018
 * Time: 19:06
 */

namespace App\Form\DataTransformer;


use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class ParagraphText
 *
 * @package App\Form\DataTransformer
 */
class ParagraphText implements DataTransformerInterface
{
    public function transform($value): string
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return (string) $value->getTextValue();
    }

    public function reverseTransform($value): \App\Component\Page\ParagraphText
    {
        return (new \App\Component\Page\ParagraphText())->setTextValue($value);
    }
}
