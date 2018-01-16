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
    /**
     * @param \App\Entity\Page\PageType|null $value
     *
     * @return string
     */
    public function transform($value)
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return $value->getPageType();
    }

    /**
     * @param string $value
     *
     * @return \App\Entity\Page\PageType|mixed
     */
    public function reverseTransform($value)
    {
        return (new \App\Entity\Page\PageType())->setPageType($value);
    }
}
