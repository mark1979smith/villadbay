<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 18/01/2018
 * Time: 19:24
 */

namespace App\Form\DataTransformer;


use Symfony\Component\Form\DataTransformerInterface;

class ListGroup implements DataTransformerInterface
{
    /**
     * @param \App\Entity\Page\ListGroup|string|null $value
     *
     * @return string
     */
    public function transform($value)
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return implode(',', $value->getListItems());
    }

    /**
     * @param string $value
     *
     * @return \App\Entity\Page\ListGroup
     */
    public function reverseTransform($value)
    {
        $stream = fopen('php://memory', 'r+');
        fwrite($stream, $value);
        rewind($stream);

        return (new \App\Entity\Page\ListGroup())->setListItems(array_map('trim', fgetcsv($stream)));
    }
}
