<?php

namespace App\Repository;

use App\Entity\ParkingSpot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ParkingSpot|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParkingSpot|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParkingSpot[]    findAll()
 * @method ParkingSpot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParkingSpotRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ParkingSpot::class);
    }

    // /**
    //  * @return ParkingSpot[] Returns an array of ParkingSpot objects
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
    public function findOneBySomeField($value): ?ParkingSpot
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
