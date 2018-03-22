<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 17/01/2018
 * Time: 20:00
 */

namespace App\Form\DataTransformer;


use Symfony\Component\Form\DataTransformerInterface;

class DisplayOrder implements DataTransformerInterface
{
    /**
     * @param \App\Entity\Page\DisplayOrder $value
     *
     * @return string
     */
    public function transform($value)
    {
        return (new \App\Entity\Page\DisplayOrder())->setDisplayOrder($value);

    }

    /**
     * @param int|string|null $value
     *
     * @return string
     */
    public function reverseTransform($value)
    {
        if (null === $value || is_string($value)) {
            return (string) $value;
        }

        return $value->getDisplayOrder();

    }
}
