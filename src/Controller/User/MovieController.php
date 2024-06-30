<?php

namespace App\Controller\User;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/user/movie')]
class MovieController extends AbstractController
{
    #[Route('/', name: 'app_user_movie_index', methods: ['GET'])]
    public function index(MovieRepository $movieRepository): Response
    {
        return $this->redirectToRoute('app_front_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/show/{id}', name: 'app_show_movie', methods: ['GET'])]
    public function show(Movie $movie, MovieRepository $movieRepository, Request $request)
    {
        return $this->render('frontend/movie/show.html.twig', [
            'movie' => $movie,
            'isconnected' => $this->getUser() != NULL,
        ]);
    }

    #[Route('/search', name: 'app_search_movie', methods: ['GET'])]
    public function searchmovie(MovieRepository $movieRepository, Request $request)
    {
        $movies = $movieRepository->findMoviesByName(
            $request->query->get('m')
        );
        return $this->render('frontend/movie/search.html.twig', [
            'txtsearch' => $request->query->get('m'),
            'movies' => $movies,
            'isconnected' => $this->getUser() != NULL,
        ]);
        dd($movies);
    }
}
