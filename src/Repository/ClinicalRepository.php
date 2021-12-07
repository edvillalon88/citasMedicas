<?php

namespace App\Repository;

use App\Entity\Clinical;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Clinical|null find($id, $lockMode = null, $lockVersion = null)
 * @method Clinical|null findOneBy(array $criteria, array $orderBy = null)
 * @method Clinical[]    findAll()
 * @method Clinical[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClinicalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Clinical::class);
    }

    // /**
    //  * @return Clinical[] Returns an array of Clinical objects
    //  */
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
    public function findOneBySomeField($value): ?Clinical
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
