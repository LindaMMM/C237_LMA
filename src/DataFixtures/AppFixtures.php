<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\RoleApp;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $role_admin = new RoleApp("ADM", "Administrateur");
        $manager->persist($role_admin);
        $role_adminst = new RoleApp("ASTK", "Administrateur stock");
        $manager->persist($role_adminst);
        $role_admin_movie = new RoleApp("AMOV", "Administrateur Movie");
        $manager->persist($role_admin_movie);
        $role_client = new RoleApp("CLT", "Client");
        $manager->persist($role_client);
        
        /* Synchronization of managed entities with the database */
        $manager->flush();
    }
}
