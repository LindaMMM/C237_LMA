<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\RoleApp;
use App\Entity\UserApp;
class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $roleAdmin = new RoleApp("ADMIN", "Administrateur");
        $manager->persist($roleAdmin);
        $roleAdminSt = new RoleApp("ADMST", "Administrateur Stock");
        $manager->persist($roleAdminSt);
        $roleAdminMv = new RoleApp("ADMMV", "Administrateur Movie");
        $manager->persist($roleAdminMv);
        $roleClient = new RoleApp("CLT", "Client");
        $manager->persist($roleClient);

        $userClient = new UserApp("name", "Client", "name@client",password_hash("Client@123", PASSWORD_DEFAULT) ,$roleClient );
        $manager->persist($userClient);
        $userAdmin = new UserApp("name", "Admin", "admin@admin",password_hash("Admin@123",PASSWORD_DEFAULT) ,$roleAdmin );
        $manager->persist($userAdmin);
        $userAdmst = new UserApp("Stock", "Admin", "Admin@Stock",password_hash("Admin@123", PASSWORD_DEFAULT) ,$roleAdminSt );
        $manager->persist($userAdmst);
        $userAdmmv = new UserApp("movie", "Admin", "Admin@movie",password_hash("Admin@123", PASSWORD_DEFAULT) ,$roleAdminMv );
        $manager->persist($userAdmmv);
        $manager->flush();
    }
}
