<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 23/01/2018
 * Time: 13:08
 */

namespace App\Form\DataTransformer;


use Symfony\Component\Form\DataTransformerInterface;

class PanoramicImage implements DataTransformerInterface
{
    /**
     * @param \App\Entity\Page\PanoramicImage|string|null $value
     *
     * @return string
     */
    public function transform($value)
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return $value->getPanoramicImage();
    }

    /**
     * @param string $value
     *
     * @return \App\Entity\Page\PanoramicImage
     */
    public function reverseTransform($value)
    {
        return (new \App\Entity\Page\PanoramicImage())->setPanoramicImage($value);
    }
}
