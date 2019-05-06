<?php

namespace App\Repository;

use App\Entity\AvailableSpot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AvailableSpot|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvailableSpot|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvailableSpot[]    findAll()
 * @method AvailableSpot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvailableSpotRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AvailableSpot::class);
    }

    // /**
    //  * @return AvailableSpot[] Returns an array of AvailableSpot objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AvailableSpot
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
