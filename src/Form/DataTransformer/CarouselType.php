<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 19/02/2018
 * Time: 19:46
 */

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;


class CarouselType implements DataTransformerInterface
{
    /**
     * @param string $value
     *
     * @return string
     */
    public function transform($value)
    {
        return (new \App\Entity\Page\Carousel())->setValue($value);

    }

    /**
     * @param \App\Entity\Page\Carousel $value
     *
     * @return string
     */
    public function reverseTransform($value)
    {
        if (null === $value || is_string($value)) {
            return (string) $value;
        }

        return $value->getValue();
    }
}
