<?php

namespace App\Repository;

use App\Entity\UserEmpresa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserEmpresa|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserEmpresa|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserEmpresa[]    findAll()
 * @method UserEmpresa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserEmpresaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserEmpresa::class);
    }

    // /**
    //  * @return UserEmpresa[] Returns an array of UserEmpresa objects
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
    public function findOneBySomeField($value): ?UserEmpresa
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
