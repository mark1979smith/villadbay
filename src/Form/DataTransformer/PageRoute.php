<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 17/01/2018
 * Time: 10:31
 */

namespace App\Form\DataTransformer;


use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class PageRoute
 *
 * @package App\Form\DataTransformer
 */
class PageRoute implements DataTransformerInterface
{
    public function transform($value): string
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return (string) $value->getPageRoute();
    }

    public function reverseTransform($value): \App\Component\Page\PageRoute
    {
        return (new \App\Component\Page\PageRoute())->setPageRoute($value);
    }
}
