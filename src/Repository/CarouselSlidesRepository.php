<?php

namespace App\Repository;

use App\Entity\CarouselSlides;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CarouselSlides|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarouselSlides|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarouselSlides[]    findAll()
 * @method CarouselSlides[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarouselSlidesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CarouselSlides::class);
    }

//    /**
//     * @return CarouselSlides[] Returns an array of CarouselSlides objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CarouselSlides
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
