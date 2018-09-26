<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 01/07/2018
 * Time: 21:26
 */

namespace App\Form\DataTransformer;


use Symfony\Component\Form\DataTransformerInterface;

class CarouselSlideHeading implements DataTransformerInterface
{
    public function transform($value)
    {
        if (null === $value || "" === $value) {
            return '';
        }

        if (is_string($value)) {
            return $value;
        }

        return $value->getValue();

    }

    public function reverseTransform($value)
    {
        dump($value);
        return (new \App\Entity\CarouselSlides\Title())->setValue($value);
    }
}
