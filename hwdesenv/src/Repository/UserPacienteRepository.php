<?php

namespace App\Repository;

use App\Entity\UserPaciente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserPaciente|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserPaciente|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserPaciente[]    findAll()
 * @method UserPaciente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserPacienteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserPaciente::class);
    }

    // /**
    //  * @return UserPaciente[] Returns an array of UserPaciente objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserPaciente
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
