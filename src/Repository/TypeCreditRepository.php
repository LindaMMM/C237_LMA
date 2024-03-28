<?php

namespace App\Repository;

use App\Entity\TypeCredit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeCredit>
 *
 * @method TypeCredit|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeCredit|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeCredit[]    findAll()
 * @method TypeCredit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeCreditRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeCredit::class);
    }

    //    /**
    //     * @return TypeCredit[] Returns an array of TypeCredit objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?TypeCredit
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
