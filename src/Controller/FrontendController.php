<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Validator\Constraints\Lenth;
use App\Entity\Movie;

class FrontendController extends AbstractController
{
    #[Route('/')]
    public function index(): Response
    {  
        $movinumber = 5;
        $mymovie = [
            'id'=>intval(25),
            'name'=>'USS LeafyCruise',
            'class'=>'Garden',
            'captain'=>'Jean-luc Pickles',
            'status'=>'construction'];

        return $this->render('frontend/index.html.twig', [
            'controller_name' => 'FrontendController',
            'movienumber'=> $movinumber,
            'mymovie'=> $mymovie,
        ]);
    }

    public function findMovieById(): Response
    {
      $response = $this->forward('App\Controller\MovieController::findMovieById', [
        
      ]);

      // ... further modify the response or return it directly

      return $response;
    }
    
    public function findMovies() 
    {
        
    }
    public function showMovieDetails(EntityManagerInterface $entityManager, int $id)
    {
        $movieRepository = $entityManager->getRepository(Movie::class);
        $movie = $movieRepository->find($id);
    
        return $this->render('frontend/show_movie_details.html.twig', [
                             'movie' => $movie]);
    }
    
}
