<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 18/01/2018
 * Time: 19:24
 */

namespace App\Form\DataTransformer;


use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class ListGroup
 *
 * @package App\Form\DataTransformer
 */
class ListGroup implements DataTransformerInterface
{
    public function transform($value): string
    {
        if (null === $value || "" === $value) {
            return '';
        }

        return implode(',', (array) $value->getListItems());
    }

    public function reverseTransform($value): \App\Component\Page\ListGroup
    {
        if (strlen($value)) {
            $stream = fopen('php://memory', 'r+');
            fwrite($stream, $value);
            rewind($stream);
            return (new \App\Component\Page\ListGroup())->setListItems(array_map('trim', fgetcsv($stream)));
        }

        return (new \App\Component\Page\ListGroup())->setListItems([]);

    }
}
