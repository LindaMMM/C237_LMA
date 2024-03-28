<?php

namespace App\Repository;

use App\Entity\MovieStock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MovieStock>
 *
 * @method MovieStock|null find($id, $lockMode = null, $lockVersion = null)
 * @method MovieStock|null findOneBy(array $criteria, array $orderBy = null)
 * @method MovieStock[]    findAll()
 * @method MovieStock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieStockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MovieStock::class);
    }

    //    /**
    //     * @return MovieStock[] Returns an array of MovieStock objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?MovieStock
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
