<?php

namespace App\Repository;

use App\Entity\MensagemMedico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MensagemMedico|null find($id, $lockMode = null, $lockVersion = null)
 * @method MensagemMedico|null findOneBy(array $criteria, array $orderBy = null)
 * @method MensagemMedico[]    findAll()
 * @method MensagemMedico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MensagemMedicoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MensagemMedico::class);
    }

    // /**
    //  * @return MensagemMedico[] Returns an array of MensagemMedico objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MensagemMedico
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
