<?php

namespace App\Controller\Admin;

use App\Entity\TypeMedia;
use App\Form\TypeMediaType;
use App\Repository\TypeMediaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/type/media')]
// #[IsGranted('ROLE_ADMIN')]
class TypeMediaController extends AbstractController
{
    #[Route('/', name: 'app_type_media_index', methods: ['GET'])]
    public function index(TypeMediaRepository $TypeMediaRepository): Response
    {
        return $this->render('backend/type_media/index.html.twig', [
            'type_medias' => $TypeMediaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_media_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeMedia = new TypeMedia();
        $form = $this->createForm(TypeMediaType::class, $typeMedia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeMedia);
            $entityManager->flush();

            return $this->redirectToRoute('app_type_media_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('backend/type_media/new.html.twig', [
            'type_media' => $typeMedia,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_media_show', methods: ['GET'])]
    public function show(TypeMedia $typeMedia): Response
    {
        return $this->render('backend/type_media/show.html.twig', [
            'type_media' => $typeMedia,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_media_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeMedia $typeMedia, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeMediaType::class, $typeMedia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('sucess', 'Le typeMedia a été modifié');
            return $this->redirectToRoute('app_type_media_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('backend/type_media/edit.html.twig', [
            'type_media' => $typeMedia,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_media_delete', methods: ['POST'])]
    public function delete(Request $request, TypeMedia $typeMedia, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $typeMedia->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($typeMedia);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_type_media_index', [], Response::HTTP_SEE_OTHER);
    }
}
