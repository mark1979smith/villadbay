<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 07/02/2018
 * Time: 11:58
 */

namespace App\Form\DataTransformer;


use Symfony\Component\Form\DataTransformerInterface;

class BackgroundImage implements DataTransformerInterface
{
    /**
     * @param \App\Entity\Page\BackgroundImage|string|null $value
     *
     * @return string
     */
    public function transform($value)
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return $value->getBackgroundImage();
    }

    /**
     * @param string $value
     *
     * @return \App\Entity\Page\BackgroundImage
     */
    public function reverseTransform($value)
    {
        return (new \App\Entity\Page\BackgroundImage())->setBackgroundImage($value);
    }
}
