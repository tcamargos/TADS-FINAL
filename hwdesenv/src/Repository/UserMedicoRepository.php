<?php

namespace App\Repository;

use App\Entity\UserMedico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserMedico|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserMedico|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserMedico[]    findAll()
 * @method UserMedico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserMedicoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserMedico::class);
    }

    // /**
    //  * @return UserMedico[] Returns an array of UserMedico objects
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
    public function findOneBySomeField($value): ?UserMedico
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
