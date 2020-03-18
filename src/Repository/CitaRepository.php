<?php

namespace App\Repository;

use App\Entity\Cita;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Cita|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cita|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cita[]    findAll()
 * @method Cita[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CitaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cita::class);
    }

    // /**
    //  * @return Cita[] Returns an array of Cita objects
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
    public function findOneBySomeField($value): ?Cita
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getLessField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.fechaHora <= :val')
            ->setParameter('val', $value)
            ->orderBy('c.fechaHora', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }

    public function getCitasTodayByType($type,$estado)
    {
        $date = new \DateTime();
        return $this->createQueryBuilder('c')
            ->andWhere('c.tipo = :tipo')
            ->andWhere('c.fechaHora >= :date_start')
            ->andWhere('c.fechaHora <= :date_end')
            ->andWhere('c.estado = :estado')
            ->setParameter('date_start', $date->format('Y-m-d 00:00:00'))
            ->setParameter('date_end', $date->format('Y-m-d 23:59:59'))
            ->setParameter('tipo', $type)
            ->setParameter('estado', $estado)
            ->getQuery()
            ->getResult()
        ;
    }

    public function getGreaterField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.fechaHora >= :val')
            ->setParameter('val', $value)
            ->orderBy('c.fechaHora', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }
}
