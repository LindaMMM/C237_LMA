<?php

namespace App\Controller\Admin;

use App\Entity\TypeCredit;
use App\Form\TypeCreditType;
use App\Repository\TypeCreditRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/type/credit')]
#[IsGranted('ROLE_ADMIN')]
class TypeCreditController extends AbstractController
{
    #[Route('/', name: 'app_type_credit_index', methods: ['GET'])]
    public function index(TypeCreditRepository $TypeCreditRepository): Response
    {
        return $this->render('backend/type_credit/index.html.twig', [
            'type_credits' => $TypeCreditRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_credit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeCredit = new TypeCredit();
        $form = $this->createForm(TypeCreditType::class, $typeCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeCredit);
            $entityManager->flush();

            return $this->redirectToRoute('app_type_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('backend/type_credit/new.html.twig', [
            'type_credit' => $typeCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_credit_show', methods: ['GET'])]
    public function show(TypeCredit $typeCredit): Response
    {
        return $this->render('backend/type_credit/show.html.twig', [
            'type_credit' => $typeCredit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_credit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeCredit $typeCredit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeCreditType::class, $typeCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('sucess', 'Le TypeCredit a été modifié');
            return $this->redirectToRoute('app_type_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('backend/type_credit/edit.html.twig', [
            'type_credit' => $typeCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_credit_delete', methods: ['POST'])]
    public function delete(Request $request, TypeCredit $typeCredit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $typeCredit->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($typeCredit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_type_credit_index', [], Response::HTTP_SEE_OTHER);
    }
}
