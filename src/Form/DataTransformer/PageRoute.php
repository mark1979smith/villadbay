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
    /**
     * @param \App\Entity\Page\PageRoute|string|null $value
     *
     * @return string
     */
    public function transform($value)
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return $value->getPageRoute();
    }

    /**
     * @param string $value
     *
     * @return \App\Entity\Page\PageType
     */
    public function reverseTransform($value)
    {
        return (new \App\Entity\Page\PageRoute())->setPageRoute($value);
    }
}
