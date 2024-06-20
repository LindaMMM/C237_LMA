<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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


    public function findallenable()
    {
        return $this->createQueryBuilder('m')
            ->leftJoin('m.movieStock', 's')
            ->where('m.Enable = TRUE')
            ->andWhere('s.stockIn > 0')
            ->groupBy('m.id')
            ->getQuery()
            ->getResult();
    }
    /*
    * @return Movie[] Returns an array of Movie objects
    */
    public function findMovies($titlemovie, $minYear, $genre)
    {
        /*$dql = "SELECT m FROM App\Entity\Movie m 
            INNER JOIN App\Entity\Genre g WITH g = m.genre 
            WHERE (:title_movie = '' OR m.name LIKE :title_movie) 
            AND (:min_year = '' OR YEAR(m.publicationDate) >= :min_year) 
            AND (:editor = '' OR b.editor = :editor) 
            ORDER BY b.title";

        $query = $this->getEntityManager()->createQuery($dql);

        return $query->execute(array(
            'title_movie' => '%' . $titlemovie . '%',
            'min_year' => $minYear,
            'genre' => $genre
        ));
        */
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

    public function findMovieById($title, $minYear, $genre): ?Movie
    {
        /*$dql = "SELECT b.id, b.title, b.publicationDate, b.pages,  
        a.firstname AS author_firstname, a.name AS author_name, 
        e.name AS editor_name 
        FROM App\Entity\Book b 
        INNER JOIN App\Entity\Author a WITH a = b.author 
        INNER JOIN App\Entity\Editor e WITH e = b.editor 
        WHERE b.id = :id";

        $query = $this->getEntityManager()->createQuery($dql);

        $books = $query->execute(array('id' => $id));

        $book = null;
        if ($books != null && isset($books[0])) {
            $book = $books[0];
        }

        return $book;
        */
        return null;
    }

    //    /**
    //     * @return Movie[] Returns an array of Movie objects
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

    //    public function findOneBySomeField($value): ?Movie
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
