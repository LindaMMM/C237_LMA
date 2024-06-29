<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\BrowserKit\Request;

/**
 * @extends ServiceEntityRepository<Movie>
 *
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }
    public static function createApprovedCriteria(): Criteria
    {
        return Criteria::create()
            ->andWhere(Criteria::expr()->eq('enable', movie::STATUS_ACTIF));
    }

    public function getAllEnableQuery()
    {
        return $this->createQueryBuilder('movie')
            ->addCriteria(self::createApprovedCriteria())
            ->leftJoin('movie.movieStock', 's')
            ->andWhere('s.stockIn > 0');
    }

    public function findMoviesByName(string $search = null): array
    {
        $queryBuilder = $this->createQueryBuilder('movie')
            ->addCriteria(self::createApprovedCriteria())
            ->orderBy('movie.id', 'DESC');
        if ($search) {
            $queryBuilder->andWhere('movie.name LIKE :searchTerm')
                ->setParameter('searchTerm', '%' . $search . '%');
            $queryBuilder->orWhere('movie.summary LIKE :searchTerm')
                ->setParameter('searchTerm', '%' . $search . '%');
        }
        return $queryBuilder
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    /**
     * Retrieve the list of active orders with all their actives packages
     * @param $page
     * @param $limit
     * @return Paginator
     */
    public function paginationMovies(int $page, int $limit): Paginator
    {
        $query = $this->getAllEnableQuery();
        $paginator = new Paginator($query, false);

        $paginator
            ->getQuery()
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit)
            ->setHint(Paginator::HINT_ENABLE_DISTINCT, false);
        return $paginator;
    }

    public function findallenable()
    {
        return $this->getAllEnableQuery()
            ->getQuery()
            ->getResult();
    }


    public function findMovieall(): array
    {
        return $this->createQueryBuilder('m')
            ->select('NEW App\\DTO\\MovieWithStock(m.id, m.name, s.stockIn, s.stockOut, s.stockReserved )')
            ->leftJoin('m.movieStock', 's')
            ->groupBy('m.id')
            ->getQuery()
            ->getResult();
    }
}
