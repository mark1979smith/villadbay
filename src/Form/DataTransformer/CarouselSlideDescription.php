<?php

namespace App\Form\DataTransformer;


use App\Component\CarouselSlides\Description;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class CarouselSlideDescription
 *
 * @package App\Form\DataTransformer
 */
class CarouselSlideDescription implements DataTransformerInterface
{
    public function transform($value): Description
    {
        return (new Description())->setValue($value);
    }

    public function reverseTransform($value): string
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return (string) $value->getValue();
    }
}
