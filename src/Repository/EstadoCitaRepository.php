<?php

namespace App\Repository;

use App\Entity\EstadoCita;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EstadoCita|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoCita|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoCita[]    findAll()
 * @method EstadoCita[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoCitaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadoCita::class);
    }

    // /**
    //  * @return EstadoCita[] Returns an array of EstadoCita objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EstadoCita
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
