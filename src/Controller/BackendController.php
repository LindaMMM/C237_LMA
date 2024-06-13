<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BackendController extends AbstractController
{
    #[Route('/backend', name: 'app_backend')]
    public function index(): Response
    {
        return $this->render('backend/index.html.twig', [
            'controller_name' => 'BackendController',
            'title' => 'Acceuil',
        ]);
    }
    public function sales() 
    {
        return $this->render('backend/index.html.twig', [
            'controller_name' => 'BackendController',
            'title' => 'Commandes',
        ]);
    }
    public function types() 
    {
        return $this->render('backend/indextypes.html.twig', [
            'controller_name' => 'BackendController',
            'title' => 'Type',
        ]);
    }
    public function movies() 
    {
        return $this->render('backend/indexmovies.html.twig', [
            'controller_name' => 'BackendController',
            'title' => 'Film',
        ]);
    }

    public function users() 
    {
        return $this->render('backend/indexusers.html.twig', [
            'controller_name' => 'BackendController',
            'title' => 'Utilisateur',
        ]);
    }

}

