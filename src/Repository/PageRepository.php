<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 02/02/2018
 * Time: 16:44
 */

namespace App\Repository;


use App\Entity\Page;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class PageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Page::class);
    }

    public function findOneByLatestPage($routeName)
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.routeName = :route')
            ->setParameter('route', $routeName)
            ->orderBy('p.id', 'DESC')
            ->getQuery();

        $page =  $qb->setMaxResults(1)->getOneOrNullResult();
        return $page;
    }
}
