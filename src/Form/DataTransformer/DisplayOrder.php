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
     * @param \App\Entity\Page\DisplayOrder|string|null $value
     *
     * @return string
     */
    public function transform($value)
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return $value->getDisplayOrder();
    }

    /**
     * @param string $value
     *
     * @return \App\Entity\Page\DisplayOrder
     */
    public function reverseTransform($value)
    {
        return (new \App\Entity\Page\DisplayOrder())->setDisplayOrder($value);
    }
}
