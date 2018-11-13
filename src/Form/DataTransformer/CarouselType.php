<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 19/02/2018
 * Time: 19:46
 */

namespace App\Form\DataTransformer;

use App\Entity\CarouselContainer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class CarouselType
 *
 * @package App\Form\DataTransformer
 */
class CarouselType implements DataTransformerInterface
{
    /** @var \Doctrine\ORM\EntityManagerInterface */
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \App\Component\Page\Carousel $value
     *
     * @return string
     */
    public function transform($value): string
    {
        if (is_null($value)) {
            return '';
        }
        return $value->getValue();

    }

    public function reverseTransform($value)
    {
        if (null === $value || is_string($value)) {
            return (string)$value;
        }

        $carouselContainer = $this->entityManager
            ->getRepository(CarouselContainer::class)
            ->find($value);
        return $carouselContainer;
    }
}
