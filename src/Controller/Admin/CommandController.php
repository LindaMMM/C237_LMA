<?php

namespace App\Controller\Admin;

use App\Entity\Command;
use App\Form\CommandType;
use App\Repository\CommandRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route('/admin/command')]
#[IsGranted('ROLE_ADMIN')]
class CommandController extends AbstractController
{
    #[Route('/', name: 'app_command_index', methods: ['GET'])]
    public function index(CommandRepository $TypeMediaRepository): Response
    {
        return $this->render('backend/command/index.html.twig', [
            'commands' => $TypeMediaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_command_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $command = new Command();
        $form = $this->createForm(CommandType::class, $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($command);
            $entityManager->flush();

            return $this->redirectToRoute('app_command_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('backend/command/new.html.twig', [
            'command' => $command,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_command_show', methods: ['GET'])]
    public function show(Command $command): Response
    {
        return $this->render('backend/type_media/show.html.twig', [
            'command' => $command,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_command_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Command $command, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommandType::class, $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('sucess','Le command a été modifié');
            return $this->redirectToRoute('app_command_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('backend/type_media/edit.html.twig', [
            'command' => $command,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_command_delete', methods: ['POST'])]
    public function delete(Request $request, Command $command, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$command->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($command);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_command_index', [], Response::HTTP_SEE_OTHER);
    }
}
