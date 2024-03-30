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
        $genre_biopic = new Genre("Biopic");
        $manager->persist($genre_biopic);
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
        $movie_bobmarley->setDateSortie(\DateTimeImmutable::createFromFormat('j-M-Y', '15-Feb-2009'));
        
        $movie_bobmarley->setSummary("Bob Marley: One Love célèbre la vie et la musique d'une icône qui a inspiré des générations à travers son message d'amour et d'unité.
        Pour la première fois sur grand écran, découvrez l'histoire puissante de Bob Marley, sa résilience face à l'adversité, le chemin qui l'a amené à sa musique révolutionnaire.");
        $movie_bobmarley->addGenre($genre_drame);
        $movie_bobmarley->addGenre($genre_biopic);
        $movie_bobmarley->addMedia(new Media("affiche", "https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcRlgIE6nCgrEqMH0nQ7r6ssEzZChjlZwVs20bqxC3u9qzFa9mWR", $type_Media_png));
        $manager->persist($movie_bobmarley);

     /*   $movie_kung  = new Movie("Kung Fu Panda 4", \DateTime::createFromFormat('Y-m-d', strtotime('2024-12-01')));
        $movie_kung->setSummary("Après trois aventures dans lesquelles le guerrier dragon Po a combattu les maîtres du mal les plus redoutables grâce à un courage et des compétences en arts martiaux inégalés, le destin va de nouveau frapper à sa porte pour… L'inviter à enfin se reposer. Plus précisément, pour être nommé chef spirituel de la vallée de la Paix. Cela pose quelques problèmes évidents.");
        $movie_kung->addMedia(new Media("affiche", "https://fr.web.img4.acsta.net/c_310_420/pictures/24/02/20/12/28/5505684.jpg", $type_Media_png));
        $movie_kung->addGenre($genre_comedy);
        $manager->persist($movie_kung);

        $movie_barbie  = new Movie("Barbie", \DateTime::createFromFormat('Y-m-d', strtotime('2024-12-01')));
        $movie_barbie->setSummary("A Barbie Land, vous êtes un être parfait dans un monde parfait. Sauf si vous êtes en crise existentielle, ou si vous êtes Ken.");
        $movie_barbie->addMedia(new Media("affiche", "https://fr.web.img2.acsta.net/c_310_420/pictures/23/06/16/12/04/4590179.jpg", $type_Media_png));
        $movie_barbie->addGenre($genre_comedy);
        $manager->persist($movie_barbie);

        $movie_vision  = new Movie("Visions", \DateTime::createFromFormat('Y-m-d', strtotime('2024-12-01')));
        $movie_vision->setSummary("Pilote de ligne confirmée, Estelle mène, entre deux vols long-courriers, une vie parfaite avec Guillaume, son mari aimant et protecteur. Un jour, par hasard, dans un couloir d'aéroport, elle recroise la route d'Ana, photographe avec qui elle a eu une aventure passionnée vingt ans plus tôt. Estelle est alors loin d'imaginer que ces retrouvailles vont l'entraîner dans une spirale cauchemardesque et faire basculer sa vie dans l'irrationnel….");
        $movie_vision->addMedia(new Media("affiche", "https://fr.web.img3.acsta.net/c_310_420/pictures/23/08/01/13/52/4599315.jpg", $type_Media_png));
        $movie_vision->addGenre($genre_drame);
        $manager->persist($movie_vision);

        $movie_dune  = new Movie("Dune : Deuxième Partie", \DateTime::createFromFormat('Y-m-d', strtotime('2024-12-01')));
        $movie_dune->setSummary("Dans DUNE : DEUXIÈME PARTIE, Paul Atreides s'unit à Chani et aux Fremen pour mener la révolte contre ceux qui ont anéanti sa famille. Hanté par de sombres prémonitions, il se trouve confronté au plus grand des dilemmes : choisir entre l'amour de sa vie et le destin de l'univers. ");
        $movie_dune->addMedia(new Media("affiche", "https://fr.web.img2.acsta.net/c_310_420/pictures/24/01/26/10/18/5392835.jpg", $type_Media_png));
        $movie_dune->addGenre($genre_drame);
        $manager->persist($movie_dune);
        
        $movie_unevie  = new Movie("Une vie", \DateTime::createFromFormat('Y-m-d', strtotime('2024-12-01')));
        $movie_unevie->setSummary("Prague, 1938. Alors que la ville est sur le point de tomber aux mains des nazis, Nicholas Winton organise des convois vers l'Angleterre, où 669 enfants juifs trouveront refuge. Cette histoire vraie, restée méconnue pendant des décennies, est dévoilée au monde entier en 1988. ");
        $movie_unevie->addGenre($genre_drame);
        $movie_dune->addMedia(new Media("affiche", "https://fr.web.img6.acsta.net/c_310_420/pictures/24/01/29/09/23/3346514.jpg", $type_Media_png));
        $manager->persist($movie_unevie);

        $movie_bolero  = new Movie("Bolero", \DateTime::createFromFormat('Y-m-d', strtotime('2024-12-01')));
        $movie_bolero->setSummary("En 1928, alors que Paris vit au rythme des années folles, la danseuse Ida Rubinstein commande à Maurice Ravel la musique de son prochain ballet. Tétanisé et en panne d'inspiration, le compositeur feuillette les pages de sa vie - les échecs de ses débuts, la fracture de la Grande Guerre, l'amour impossible qu'il éprouve pour sa muse Misia Sert… Ravel va alors plonger au plus profond de lui-même pour créer son oeuvre universelle, le Bolero");
        $movie_unevie->addGenre($genre_biopic);
        $manager->persist($movie_bolero);

        $movie_anatomie  = new Movie("Anatomie d'une chute", \DateTime::createFromFormat('Y-m-d', strtotime('2024-12-01')));
        $movie_anatomie->setSummary("Sandra, Samuel et leur fils malvoyant de 11 ans, Daniel, vivent depuis un an loin de tout, à la montagne. Un jour, Samuel est retrouvé mort au pied de leur maison. Une enquête pour mort suspecte est ouverte. Sandra est bientôt inculpée malgré le doute : suicide ou homicide ? Un an plus tard, Daniel assiste au procès de sa mère, véritable dissection du couple.");
        $movie_anatomie->addGenre($genre_drame);
        $movie_anatomie->addMedia(new Media("affiche", "https://fr.web.img6.acsta.net/c_310_420/o_club-allocine-2024-310x420.png_0_se/pictures/24/03/01/10/28/1051187.jpg", $type_Media_png));
        $manager->persist($movie_anatomie);

        $movie_restedemain  = new Movie("Il reste encore demain", \DateTime::createFromFormat('Y-m-d', strtotime('2024-12-01')));
        $movie_restedemain->setSummary("Mariée à un homme autoritaire et violent, Delia, mère de trois enfants, vit à Rome dans la seconde moitié des années 40. L'arrivée d'une lettre mystérieuse va tout bouleverser et pousser Delia à trouver le courage d'imaginer un avenir meilleur, et pas seulement pour elle-même.");
        $movie_restedemain->addGenre($genre_comedy);
        $movie_restedemain->addMedia(new Media("affiche", "https://fr.web.img3.acsta.net/c_310_420/pictures/24/01/04/15/30/4203338.jpg", $type_Media_png));
        $manager->persist($movie_restedemain);

        $movie_heureuxgagnants  = new Movie("Heureux gagnants", \DateTime::createFromFormat('Y-m-d', strtotime('2024-12-01')));
        $movie_heureuxgagnants->setSummary("1 chance sur 19 millions. Plus de probabilité d'être frappé par une météorite que de gagner au loto. Pour nos heureux gagnants, le rêve va rapidement se transformer en cauchemar, et leur vie va voler en éclat dans un spectaculaire feu d'artifices de comédie noire et de sensations fortes. .");
        $movie_heureuxgagnants->addGenre($genre_comedy);
        $movie_heureuxgagnants->addMedia(new Media("affiche", "https://fr.web.img6.acsta.net/c_310_420/pictures/24/01/17/11/50/4118109.jpg", $type_Media_png));
        $manager->persist($movie_heureuxgagnants);
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
