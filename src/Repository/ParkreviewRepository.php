<?php

namespace App\Repository;

use App\Entity\Parkreview;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Parkreview|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parkreview|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parkreview[]    findAll()
 * @method Parkreview[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParkreviewRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Parkreview::class);
    }

    // /**
    //  * @return Parkreview[] Returns an array of Parkreview objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Parkreview
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
