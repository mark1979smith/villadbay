<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 17/01/2018
 * Time: 20:00
 */

namespace App\Form\DataTransformer;


use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class DisplayOrder
 *
 * @package App\Form\DataTransformer
 */
class DisplayOrder implements DataTransformerInterface
{
    public function transform($value): \App\Component\Page\DisplayOrder
    {
        return (new \App\Component\Page\DisplayOrder())->setDisplayOrder($value);

    }

    public function reverseTransform($value): string
    {
        if (null === $value || is_string($value)) {
            return (string) $value;
        }

        return $value->getDisplayOrder();

    }
}
