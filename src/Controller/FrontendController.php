<?php

namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;

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
    public function index(ClientRepository $clientRepository, UserPasswordHasherInterface $hacher): Response
    {
        $client = new Client();

        if ($this->getUser() != NULL) {
            $client = $clientRepository->findbByUser($this->getUser());
        }
        if ($client == NULL) {
            return $this->render('backend/index.html.twig', [
                'controller_name' => 'BackendController',
                'title' => 'Acceuil',
            ]);
        } else {
            return $this->render('frontend/index.html.twig', [
                'controller_name' => 'FrontendController',
                'isconnected' => $this->getUser() != NULL,
                'client' =>  $client,
            ]);
        }
    }
}
