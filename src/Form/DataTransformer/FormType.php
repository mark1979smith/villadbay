<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 16/02/2018
 * Time: 13:11
 */

namespace App\Form\DataTransformer;


use App\Component\Page\Form;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class FormType
 *
 * @package App\Form\DataTransformer
 */
class FormType implements DataTransformerInterface
{
    public function transform($value): Form
    {
        return (new Form())->setFormType($value);

    }

    public function reverseTransform($value): string
    {
        if (null === $value || is_string($value)) {
            return (string) $value;
        }

        return (string) $value->getFormType();
    }
}
