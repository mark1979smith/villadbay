<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 07/02/2018
 * Time: 11:58
 */

namespace App\Form\DataTransformer;


use App\Component\Helpers\ScreenSize;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class BackgroundImage
 *
 * @package App\Form\DataTransformer
 */
class BackgroundImage implements DataTransformerInterface
{

    public function transform($value)
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return $value->getBackgroundImage(new ScreenSize(ScreenSize::EXTRA_LARGE));
    }

    public function reverseTransform($value): \App\Component\Page\BackgroundImage
    {
        return (new \App\Component\Page\BackgroundImage())->setBackgroundImage($value);
    }
}
