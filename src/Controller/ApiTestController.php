<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\TypeCreditRepository;
use App\Entity\TypeMedia;
#[Route('/api/test')]
class ApiTestController extends AbstractController{
    #[Route('/', methods:['GET'])]
    public function getCollections(TypeCreditRepository $movieRepository): Response
    {  
        $all= $movieRepository->findAll();
        return $this->json($all);
        

    }
    #[Route('/{id<\d+>}', methods:['GET'])]
    public function getbyId(int $id,TypeCreditRepository $movieRepository): Response
    {    
        $all= $movieRepository->find($id);
        
        return $this->json($all);
    }

    #[Route('/typemedia/{id}/edit',name:"typemedia_show", methods:['GET'])]
    public function show(TypeMedia $typemedia): Response
    {    
        dd($typemedia);
        
    }

}