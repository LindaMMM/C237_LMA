<?php

namespace App\Controller\User;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/user/user')]
#[IsGranted('ROLE_USER')]
class ClientController extends AbstractController
{
    #[Route('/', name: 'app_front_client_index', methods: ['GET'])]
    public function index(ClientRepository $clientRepository): Response
    {
        return $this->render('frontend/client/index.html.twig', [
            'clients' => $clientRepository->findAll(),
        ]);
    }

    #[Route('/add_basket/{id}', name: 'app_user_add_basket', methods: ['POST'])]
    public function add_basket(ClientRepository $clientRepository, int $id): Response
    {
        return $this->render('frontend/client/index.html.twig', [
            'clients' => $clientRepository->findAll(),
        ]);
    }

    #[Route('/valid_basket/{id}', name: 'app_user_add_basket', methods: ['POST'])]
    public function valid_basket(ClientRepository $clientRepository, int $id): Response
    {
        return $this->render('frontend/client/index.html.twig', [
            'clients' => $clientRepository->findAll(),
        ]);
    }
}
