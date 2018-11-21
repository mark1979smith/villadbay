<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 23/01/2018
 * Time: 13:08
 */

namespace App\Form\DataTransformer;


use App\Component\Helpers\ScreenSize;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class PanoramicImage
 *
 * @package App\Form\DataTransformer
 */
class PanoramicImage implements DataTransformerInterface
{
    public function transform($value): string
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return $value->getPanoramicImage(new ScreenSize(ScreenSize::EXTRA_LARGE));
    }

    public function reverseTransform($value): \App\Component\Page\PanoramicImage
    {
        return (new \App\Component\Page\PanoramicImage())->setPanoramicImage($value);
    }
}
