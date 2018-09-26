<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 01/07/2018
 * Time: 21:27
 */

namespace App\Form\DataTransformer;


use Symfony\Component\Form\DataTransformerInterface;

class CarouselSlideImage implements DataTransformerInterface
{
    public function transform($value)
    {
        return (new \App\Entity\CarouselSlides\Image())->setValue($value);
    }

    public function reverseTransform($value)
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return $value->getValue();
    }
}
