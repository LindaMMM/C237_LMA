<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Utilisateur;
 
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
      
        // Users
        $user_fabien_admin = new Utilisateur();
        $user_fabien_admin->setEmail("fabien@admin");
        $user_fabien_admin->setRoles(['ROLE_ADMIN']);
        $user_fabien_admin->setPassword($this->passwordEncoder
                                            ->hashPassword($user_fabien_admin,
                                                            "1 2 3 Nous irons au bois !"));
        $manager->persist($user_fabien_admin);
        $manager->flush();
    }
}
