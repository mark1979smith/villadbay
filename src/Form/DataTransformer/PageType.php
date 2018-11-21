<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 16/01/2018
 * Time: 11:01
 */

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class PageType
 *
 * @package App\Form\DataTransformer
 */
class PageType implements DataTransformerInterface
{
    public function transform($value): string
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return (string) $value->getPageType();
    }

    public function reverseTransform($value): \App\Component\Page\PageType
    {
        return (new \App\Component\Page\PageType())->setPageType($value);
    }
}
