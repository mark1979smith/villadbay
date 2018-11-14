<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 01/07/2018
 * Time: 21:26
 */

namespace App\Form\DataTransformer;


use App\Component\CarouselSlides\Title;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class CarouselSlideHeading
 *
 * @package App\Form\DataTransformer
 */
class CarouselSlideHeading implements DataTransformerInterface
{
    public function transform($value): string
    {
        if (null === $value || "" === $value) {
            return '';
        }

        if (is_string($value)) {
            return $value;
        }

        return (string) $value->getValue();

    }

    public function reverseTransform($value): Title
    {
        return (new Title())->setValue($value);
    }
}
