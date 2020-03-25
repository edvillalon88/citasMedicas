<?php

namespace App\Repository;

use App\Entity\Paciente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Paciente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Paciente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Paciente[]    findAll()
 * @method Paciente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PacienteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Paciente::class);
    }

    // /**
    //  * @return Paciente[] Returns an array of Paciente objects
    //  */
    
    public function findAnotherByTelefono($value, $id)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.telefono = :val')
            ->andWhere('p.id <> :id')
            ->setParameter('val', $value)
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;
    }
    public function findAnotherByCorreo($value, $id)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.correo = :val')
            ->andWhere('p.id <> :id')
            ->setParameter('val', $value)
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;
    }
    public function searchPaciente($value)
    {
        return $this->createQueryBuilder('p')
            ->where("p.correo like :val")
            ->orWhere("CONCAT(p.nombre, ' ', p.apellidos)  like :val")
            ->orWhere("p.telefono like :val")
            ->setParameter('val', '%'.$value.'%')            
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Paciente
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
