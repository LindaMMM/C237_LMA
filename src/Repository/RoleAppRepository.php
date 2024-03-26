<?php

namespace App\Repository;

use App\Entity\RoleApp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RoleApp>
 *
 * @method RoleApp|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoleApp|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoleApp[]    findAll()
 * @method RoleApp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleAppRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoleApp::class);
    }

    //    /**
    //     * @return RoleApp[] Returns an array of RoleApp objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?RoleApp
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
