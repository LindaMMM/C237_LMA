<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use App\Entity\Media;
use App\Entity\TypeCredit;
use App\Entity\TypeMedia;
use App\Entity\Movie;
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
        // Genre
        $genre_drame = new Genre("Drame");
        $manager->persist($genre_drame);
        $genre_action = new Genre("Action");
        $manager->persist($genre_action);
        $genre_horror = new Genre("Horreur");
        $manager->persist($genre_horror);
        $genre_comedy = new Genre("Comédie");
        $manager->persist($genre_comedy);
        // Type Credit
        $type_credit_10= new TypeCredit("10 unités", 10, 4);
        $type_credit_10->setEnable(True);
        $manager->persist($type_credit_10);

        $type_credit_30= new TypeCredit("30 unités", 30, 8);
        $type_credit_30->setEnable(True);
        $manager->persist($type_credit_30);

        $type_credit_50= new TypeCredit("50 unités", 50, 10);
        $type_credit_50->setEnable(True);
        $manager->persist($type_credit_50);

        $type_credit_100 = new TypeCredit("100 unités", 100, 15);
        $type_credit_100->setEnable(True);
        $manager->persist($type_credit_100);
        // Type Media
        $type_Media_png = new TypeMedia("PNG","Images PNG");
        $manager->persist($type_Media_png);
        $type_Media_mp4 = new TypeMedia("MP4","Vidéo");
        $manager->persist($type_Media_mp4);
        
        // Films
        $movie_bobmarley  = new Movie("Bob Marley: One love");
        $movie_bobmarley->setSummary("Bob Marley: One Love célèbre la vie et la musique d'une icône qui a inspiré des générations à travers son message d'amour et d'unité.
        Pour la première fois sur grand écran, découvrez l'histoire puissante de Bob Marley, sa résilience face à l’adversité, le chemin qui l’a amené à sa musique révolutionnaire.");
        $movie_bobmarley->addGenre($genre_drame);
        $movie_bobmarley->addMedia(new Media("affiche", "https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcRlgIE6nCgrEqMH0nQ7r6ssEzZChjlZwVs20bqxC3u9qzFa9mWR", $type_Media_png));
        $manager->persist($movie_bobmarley);

        $movie_kung  = new Movie("Kung Fu Panda 4");
        $movie_kung->setSummary("Après trois aventures dans lesquelles le guerrier dragon Po a combattu les maîtres du mal les plus redoutables grâce à un courage et des compétences en arts martiaux inégalés, le destin va de nouveau frapper à sa porte pour… L’inviter à enfin se reposer. Plus précisément, pour être nommé chef spirituel de la vallée de la Paix. Cela pose quelques problèmes évidents.");
        $movie_bobmarley->addMedia(new Media("affiche", "https://www.allocine.fr/video/player_gen_cmedia=19604634&cfilm=306226.html", $type_Media_png));
        $movie_kung->addGenre($genre_comedy);
        $manager->persist($movie_kung);

        $movie_bobmarley  = new Movie("Bob Marley: One love");
        $movie_bobmarley->setSummary("Bob Marley: One Love célèbre la vie et la musique d'une icône qui a inspiré des générations à travers son message d'amour et d'unité.
        Pour la première fois sur grand écran, découvrez l'histoire puissante de Bob Marley, sa résilience face à l’adversité, le chemin qui l’a amené à sa musique révolutionnaire.");
        
        $manager->persist($movie_bobmarley);

        $movie_bobmarley  = new Movie("Bob Marley: One love");
        $movie_bobmarley->setSummary("Bob Marley: One Love célèbre la vie et la musique d'une icône qui a inspiré des générations à travers son message d'amour et d'unité.
        Pour la première fois sur grand écran, découvrez l'histoire puissante de Bob Marley, sa résilience face à l’adversité, le chemin qui l’a amené à sa musique révolutionnaire.");
        
        $manager->persist($movie_bobmarley);
        $movie_bobmarley  = new Movie("Bob Marley: One love");
        $movie_bobmarley->setSummary("Bob Marley: One Love célèbre la vie et la musique d'une icône qui a inspiré des générations à travers son message d'amour et d'unité.
        Pour la première fois sur grand écran, découvrez l'histoire puissante de Bob Marley, sa résilience face à l’adversité, le chemin qui l’a amené à sa musique révolutionnaire.");
        
        $manager->persist($movie_bobmarley);
        $movie_bobmarley  = new Movie("Bob Marley: One love");
        $movie_bobmarley->setSummary("Bob Marley: One Love célèbre la vie et la musique d'une icône qui a inspiré des générations à travers son message d'amour et d'unité.
        Pour la première fois sur grand écran, découvrez l'histoire puissante de Bob Marley, sa résilience face à l’adversité, le chemin qui l’a amené à sa musique révolutionnaire.");
        
        $manager->persist($movie_bobmarley);
        $movie_bobmarley  = new Movie("Bob Marley: One love");
        $movie_bobmarley->setSummary("Bob Marley: One Love célèbre la vie et la musique d'une icône qui a inspiré des générations à travers son message d'amour et d'unité.
        Pour la première fois sur grand écran, découvrez l'histoire puissante de Bob Marley, sa résilience face à l’adversité, le chemin qui l’a amené à sa musique révolutionnaire.");
        
        $manager->persist($movie_bobmarley);
        $movie_bobmarley  = new Movie("Bob Marley: One love");
        $movie_bobmarley->setSummary("Bob Marley: One Love célèbre la vie et la musique d'une icône qui a inspiré des générations à travers son message d'amour et d'unité.
        Pour la première fois sur grand écran, découvrez l'histoire puissante de Bob Marley, sa résilience face à l’adversité, le chemin qui l’a amené à sa musique révolutionnaire.");
        $manager->persist($movie_bobmarley);
        $movie_bobmarley  = new Movie("Bob Marley: One love");
        $movie_bobmarley->setSummary("Bob Marley: One Love célèbre la vie et la musique d'une icône qui a inspiré des générations à travers son message d'amour et d'unité.
        Pour la première fois sur grand écran, découvrez l'histoire puissante de Bob Marley, sa résilience face à l’adversité, le chemin qui l’a amené à sa musique révolutionnaire.");
        
        $manager->persist($movie_bobmarley);
        $movie_bobmarley  = new Movie("Bob Marley: One love");
        $movie_bobmarley->setSummary("Bob Marley: One Love célèbre la vie et la musique d'une icône qui a inspiré des générations à travers son message d'amour et d'unité.
        Pour la première fois sur grand écran, découvrez l'histoire puissante de Bob Marley, sa résilience face à l’adversité, le chemin qui l’a amené à sa musique révolutionnaire.");
        
        $manager->persist($movie_bobmarley);

        
/*
        
  */      
        // 
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
