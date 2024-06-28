<?php

namespace App\Controller\User;

use App\Entity\Client;
use App\Form\ClientType;
use App\Form\CreditType;
use App\Repository\ClientRepository;
use App\Repository\TypeCreditRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/user')]
#[IsGranted('ROLE_USER')]
class ClientController extends AbstractController
{
    #[Route('/', name: 'app_front_client_index', methods: ['GET'])]
    public function index(ClientRepository $clientRepository): Response
    {
        return $this->render('frontend/index.html.twig', [
            'controller_name' => 'FrontendController',
            'isconnected' => $this->getUser() != NULL,

        ]);
    }
    #[Route('/profil', name: 'app_user_client', methods: ['GET', 'POST'])]
    public function profil(ClientRepository $clientRepository, Request $request, EntityManagerInterface $entityManager):  Response
    {
        $client = $clientRepository->getByUserId($this->getUser());
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($client);
            $entityManager->flush();
            return $this->redirectToRoute('app_front_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('frontend/user/profil.html.twig', [
            'form' => $form,
            'client' => $client,
            'isconnected' => $this->getUser() != NULL,
        ]);
        
        
    }
    #[Route('/addCredit/{id}', name: 'app_user_add_credit', methods: ['GET', 'POST'])]
    public function addCredit(Client $client, TypeCreditRepository $typecreditRepository,  Request $request, EntityManagerInterface $entityManager): Response
    {
        $typescredit = $typecreditRepository->getallEnable();
        $form = $this->createForm(CreditType::class, $client->getCredit());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dd($client);
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->render('frontend/index.html.twig', [
                'controller_name' => 'FrontendController',
                'isconnected' => $this->getUser() != NULL,
            ]);
            
        }

        return $this->render('frontend/user/type_credit.html.twig', [
            'form' => $form,
            'types_credit' => $typescredit,
            'client' => $client,
            'isconnected' => $this->getUser() != NULL,
        ]);
    }
    
    #[Route('/basket', name: 'app_user_client_basket', methods: ['GET'])]
    public function basket(ClientRepository $clientRepository): Response
    {
        return $this->render('frontend/index.html.twig', [
            'controller_name' => 'FrontendController',
            'isconnected' => $this->getUser() != NULL,

        ]);
    }
    #[Route('/commands', name: 'app_user_client_collection', methods: ['GET'])]
    public function commands(ClientRepository $clientRepository): Response
    {
        return $this->render('frontend/index.html.twig', [
            'controller_name' => 'FrontendController',
            'isconnected' => $this->getUser() != NULL,

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
