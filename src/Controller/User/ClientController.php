<?php

namespace App\Controller\User;

use App\Entity\Client;
use App\DTO\AddCredit;
use App\Form\ClientType;
use App\Form\CreditType;
use App\Repository\ClientRepository;
use App\Repository\TypeCreditRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/user')]
#[IsGranted('ROLE_USER')]
class ClientController extends AbstractController
{

    #[Route('/profil', name: 'app_user_client', methods: ['GET', 'POST'])]
    public function profil(ClientRepository $clientRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $client = $clientRepository->getByUserId($this->getUser());
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($client);
            $entityManager->flush();
            $this->addFlash('notice', 'le profil a été mise à jour.');

            return $this->redirectToRoute('app_user_movie_index', [], Response::HTTP_SEE_OTHER);
        } elseif ($form->isSubmitted()) {
            $this->addFlash('erreur', "le profil n'a pas été mise à jour.");
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
        $newcredit = new AddCredit();
        $form = $this->createFormBuilder($newcredit)
            ->add('quantite', null, ['attr' => array(
                'readonly' => true,
            )])
            ->add('save', SubmitType::class, ['label' => 'sauvegarder', 'attr' => ['class' => 'btn btn-blue btn-blue:hover']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $toupdatecredit = $client->getCredit();
            $toupdatecredit->addCredit($newcredit->getQuantite());
            $entityManager->persist($client);
            $entityManager->flush();
            $this->addFlash('notice', 'Le crédit a été mise à jour.');
            return $this->redirectToRoute('app_user_client', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('frontend/user/type_credit.html.twig', [
            'form' => $form,
            'types_credit' => $typescredit,
            'credit' => $newcredit,
            'isconnected' => $this->getUser() != NULL,
        ]);
    }

    #[Route('/basket', name: 'app_user_client_basket', methods: ['GET'])]
    public function basket(ClientRepository $clientRepository): Response
    {
        $client = $clientRepository->getByUserId($this->getUser());
        return $this->render('frontend/user/basket.html.twig', [
            'controller_name' => 'FrontendController',
            'isconnected' => $this->getUser() != NULL,
            'client' => $client,

        ]);
    }
    #[Route('/commands', name: 'app_user_client_collection', methods: ['GET'])]
    public function commands(ClientRepository $clientRepository): Response
    {
        return $this->render('frontend/user/indexcmd.html.twig', [
            'controller_name' => 'FrontendController',
            'isconnected' => $this->getUser() != NULL,

        ]);
    }


    #[Route('/add_basket/{id}', name: 'app_user_add_basket', methods: ['POST'])]
    public function add_basket(ClientRepository $clientRepository, int $id, Request $request)
    {
        $this->addFlash(
            'notice',
            'le film ajouter au panier'
        );

        return $this->redirectToRoute('app_user_movie_index');
    }

    #[Route('/valid_basket/{id}', name: 'app_user_valid_basket', methods: ['POST'])]
    public function valid_basket(ClientRepository $clientRepository, int $id): Response
    {
        return $this->render('frontend/client/index.html.twig', [
            'clients' => $clientRepository->findAll(),
        ]);
    }
}
