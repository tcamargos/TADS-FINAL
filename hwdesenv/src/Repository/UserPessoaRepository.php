<?php

namespace App\Repository;

use App\Entity\UserPessoa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserPessoa|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserPessoa|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserPessoa[]    findAll()
 * @method UserPessoa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserPessoaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserPessoa::class);
    }

    // /**
    //  * @return UserPessoa[] Returns an array of UserPessoa objects
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
    public function findOneBySomeField($value): ?UserPessoa
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
