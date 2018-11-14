<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 18/01/2018
 * Time: 12:17
 */

namespace App\Form\DataTransformer;


use App\Component\Page\TextLead;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class TextLeading
 *
 * @package App\Form\DataTransformer
 */
class TextLeading implements DataTransformerInterface
{
    public function transform($value): string
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return (string) $value->getTextValue();
    }

    public function reverseTransform($value): TextLead
    {
        return (new TextLead())->setTextValue($value);
    }
}
