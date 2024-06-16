<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
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
use App\Entity\Utilisateur;

class FrontendController extends AbstractController
{
    #[Route('/')]
    public function index(EntityManagerInterface $em,UserPasswordHasherInterface $hacher): Response
    {  
        return $this->render('frontend/index.html.twig', [
            'controller_name' => 'FrontendController',
            'isconnected'=>$this->getUser()!=NULL,
            
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
