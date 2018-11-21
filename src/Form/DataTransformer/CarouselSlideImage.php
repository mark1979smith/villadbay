<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 01/07/2018
 * Time: 21:27
 */

namespace App\Form\DataTransformer;


use App\Component\CarouselSlides\Image;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class CarouselSlideImage
 *
 * @package App\Form\DataTransformer
 */
class CarouselSlideImage implements DataTransformerInterface
{
    public function transform($value): Image
    {
        return (new Image())->setValue($value);
    }

    public function reverseTransform($value): string
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return (string) $value->getValue();
    }
}
