<?php

namespace App\Repository;

use App\Entity\Placetype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Placetype|null find($id, $lockMode = null, $lockVersion = null)
 * @method Placetype|null findOneBy(array $criteria, array $orderBy = null)
 * @method Placetype[]    findAll()
 * @method Placetype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlacetypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Placetype::class);
    }

    // /**
    //  * @return Placetype[] Returns an array of Placetype objects
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
    public function findOneBySomeField($value): ?Placetype
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
