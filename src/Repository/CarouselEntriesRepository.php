<?php

namespace App\Repository;

use App\Entity\CarouselEntries;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CarouselEntries|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarouselEntries|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarouselEntries[]    findAll()
 * @method CarouselEntries[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarouselEntriesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CarouselEntries::class);
    }

//    /**
//     * @return CarouselEntries[] Returns an array of CarouselEntries objects
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
    public function findOneBySomeField($value): ?CarouselEntries
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
