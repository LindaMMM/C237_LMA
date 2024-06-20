<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use App\Entity\Media;
use App\Entity\TypeCredit;
use App\Entity\TypeMedia;
use App\Entity\Movie;
use App\Entity\MovieStock;
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
        $genre_drame = new Genre();
        $genre_drame->setName("Drame");
        $manager->persist($genre_drame);
        $genre_action = new Genre();
        $genre_action->setName("Action");
        $manager->persist($genre_action);

        $genre_horror = new Genre();
        $genre_horror->setName("Horreur");
        $manager->persist($genre_horror);

        $genre_comedy = new Genre();
        $genre_comedy->setName("Comédie");
        $manager->persist($genre_comedy);

        $genre_biopic = new Genre();
        $genre_biopic->setName("Biopic");
        $manager->persist($genre_biopic);
        // Type Credit
        $type_credit_10 = new TypeCredit();
        $type_credit_10->setName("10 unités");
        $type_credit_10->setPrix(4);
        $type_credit_10->setNbCredit(10);
        $type_credit_10->setEnable(True);
        $manager->persist($type_credit_10);

        $type_credit_30 = new TypeCredit();
        $type_credit_30->setName("30 unités");
        $type_credit_30->setPrix(8);
        $type_credit_30->setNbCredit(30);

        $type_credit_30->setEnable(True);
        $manager->persist($type_credit_30);

        $type_credit_50 = new TypeCredit();
        $type_credit_50->setName("50 unités");
        $type_credit_50->setPrix(10);
        $type_credit_50->setNbCredit(50);
        $type_credit_50->setEnable(True);
        $manager->persist($type_credit_50);

        $type_credit_100 = new TypeCredit();
        $type_credit_100->setName("100 unités");
        $type_credit_100->setPrix(15);
        $type_credit_100->setNbCredit(100);
        $type_credit_100->setEnable(True);
        $manager->persist($type_credit_100);

        // Type Media
        $type_Media_png = new TypeMedia();
        $type_Media_png->setCode("PNG");
        $type_Media_png->setName("Images PNG");

        $manager->persist($type_Media_png);
        $type_Media_mp4 = new TypeMedia();
        $type_Media_mp4->setCode("MP4");
        $type_Media_mp4->setName("Vidéo");

        $manager->persist($type_Media_mp4);

        // Films
        $media = new Media();
        $media->setName("affiche");
        $media->setPath("https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcRlgIE6nCgrEqMH0nQ7r6ssEzZChjlZwVs20bqxC3u9qzFa9mWR");
        $media->setType($type_Media_png);

        $movie_bobmarley  = new Movie();
        $movie_bobmarley->setName("Bob Marley: One love");
        $movie_bobmarley->setDateSortie(\DateTimeImmutable::createFromFormat('j-M-Y', '14-Feb-2024'));
        $movie_bobmarley->setSummary("Bob Marley: One Love célèbre la vie et la musique d'une icône qui a inspiré des générations à travers son message d'amour et d'unité.
        Pour la première fois sur grand écran, découvrez l'histoire puissante de Bob Marley, sa résilience face à l'adversité, le chemin qui l'a amené à sa musique révolutionnaire.");
        $movie_bobmarley->addGenre($genre_drame);
        $movie_bobmarley->addGenre($genre_biopic);
        $movie_bobmarley->setMovieStock(new MovieStock());
        $movie_bobmarley->addMedia($media);
        $movie_bobmarley->setEnable(true);
        $manager->persist($movie_bobmarley);

        $media_kung = new Media();
        $media_kung->setName("affiche");
        $media_kung->setPath("https://fr.web.img4.acsta.net/c_310_420/pictures/24/02/20/12/28/5505684.jpg");
        $media_kung->setType($type_Media_png);

        $movie_kung  = new Movie();
        $movie_kung->setName("Kung Fu Panda 4");
        $movie_kung->setDateSortie(\DateTimeImmutable::createFromFormat('j-M-Y', '27-Mar-2024'));
        $movie_kung->setSummary("Après trois aventures dans lesquelles le guerrier dragon Po a combattu les maîtres du mal les plus redoutables grâce à un courage et des compétences en arts martiaux inégalés, le destin va de nouveau frapper à sa porte pour… L'inviter à enfin se reposer. Plus précisément, pour être nommé chef spirituel de la vallée de la Paix. Cela pose quelques problèmes évidents.");
        $movie_kung->addMedia($media_kung);
        $movie_kung->addGenre($genre_comedy);
        $movie_kung->setEnable(true);
        $movie_kung->setMovieStock(new MovieStock());
        $manager->persist($movie_kung);

        $media_barbie = new Media();
        $media_barbie->setName("affiche");
        $media_barbie->setPath("https://fr.web.img2.acsta.net/c_310_420/pictures/23/06/16/12/04/4590179.jpg");
        $media_barbie->setType($type_Media_png);

        $movie_barbie  = new Movie();
        $movie_barbie->setName("Barbie");
        $movie_barbie->setDateSortie(\DateTimeImmutable::createFromFormat('j-M-Y', '19-Jul-2023'));
        $movie_barbie->setSummary("A Barbie Land, vous êtes un être parfait dans un monde parfait. Sauf si vous êtes en crise existentielle, ou si vous êtes Ken.");
        $movie_barbie->addMedia($media_barbie);
        $movie_barbie->addGenre($genre_comedy);
        $movie_barbie->setEnable(true);
        $movie_barbie->setMovieStock(new MovieStock());
        $manager->persist($movie_barbie);

        $media_vision = new Media();
        $media_vision->setName("affiche");
        $media_vision->setPath("https://fr.web.img3.acsta.net/c_310_420/pictures/23/08/01/13/52/4599315.jpg");
        $media_vision->setType($type_Media_png);

        $movie_vision  = new Movie();
        $movie_vision->setName("Visions");
        $movie_vision->setDateSortie(\DateTimeImmutable::createFromFormat('j-M-Y', '06-Sep-2023'));
        $movie_vision->setSummary("Pilote de ligne confirmée, Estelle mène, entre deux vols long-courriers, une vie parfaite avec Guillaume, son mari aimant et protecteur. Un jour, par hasard, dans un couloir d'aéroport, elle recroise la route d'Ana, photographe avec qui elle a eu une aventure passionnée vingt ans plus tôt. Estelle est alors loin d'imaginer que ces retrouvailles vont l'entraîner dans une spirale cauchemardesque et faire basculer sa vie dans l'irrationnel….");
        $movie_vision->addMedia($media_vision);
        $movie_vision->addGenre($genre_drame);
        $movie_vision->setEnable(true);
        $movie_vision->setMovieStock(new MovieStock());
        $manager->persist($movie_vision);

        $media_dune = new Media();
        $media_dune->setName("affiche");
        $media_dune->setPath("https://fr.web.img2.acsta.net/c_310_420/pictures/24/01/26/10/18/5392835.jpg");
        $media_dune->setType($type_Media_png);
        $movie_dune  = new Movie();
        $movie_dune->setName("Dune : Deuxième Partie");
        $movie_dune->setDateSortie(\DateTimeImmutable::createFromFormat('j-M-Y', '28-Feb-2024'));
        $movie_dune->setSummary("Dans DUNE : DEUXIÈME PARTIE, Paul Atreides s'unit à Chani et aux Fremen pour mener la révolte contre ceux qui ont anéanti sa famille. Hanté par de sombres prémonitions, il se trouve confronté au plus grand des dilemmes : choisir entre l'amour de sa vie et le destin de l'univers. ");
        $movie_dune->addMedia($media_dune);
        $movie_dune->addGenre($genre_drame);
        $movie_dune->setEnable(true);
        $movie_dune->setMovieStock(new MovieStock());
        $manager->persist($movie_dune);

        $media_unevie = new Media();
        $media_unevie->setName("affiche");
        $media_unevie->setPath("https://fr.web.img6.acsta.net/c_310_420/pictures/24/01/29/09/23/3346514.jpg");
        $media_unevie->setType($type_Media_png);
        $movie_unevie  = new Movie();
        $movie_unevie->setName("Une vie");
        $movie_unevie->setDateSortie(\DateTimeImmutable::createFromFormat('j-M-Y', '21-Feb-2024'));
        $movie_unevie->setSummary("Prague, 1938. Alors que la ville est sur le point de tomber aux mains des nazis, Nicholas Winton organise des convois vers l'Angleterre, où 669 enfants juifs trouveront refuge. Cette histoire vraie, restée méconnue pendant des décennies, est dévoilée au monde entier en 1988. ");
        $movie_unevie->addGenre($genre_drame);
        $movie_unevie->setEnable(true);
        $movie_unevie->addMedia($media_unevie);
        $movie_unevie->setMovieStock(new MovieStock());
        $manager->persist($movie_unevie);

        $media_bolero = new Media();
        $media_bolero->setName("affiche");
        $media_bolero->setPath("https://fr.web.img5.acsta.net/c_310_420/pictures/24/01/26/11/07/0253122.jpg");
        $media_bolero->setType($type_Media_png);
        $movie_bolero  = new Movie();
        $movie_bolero->setName("Bolero");
        $movie_bolero->setDateSortie(\DateTimeImmutable::createFromFormat('j-M-Y', '06-Mar-2023'));
        $movie_bolero->setSummary("En 1928, alors que Paris vit au rythme des années folles, la danseuse Ida Rubinstein commande à Maurice Ravel la musique de son prochain ballet. Tétanisé et en panne d'inspiration, le compositeur feuillette les pages de sa vie - les échecs de ses débuts, la fracture de la Grande Guerre, l'amour impossible qu'il éprouve pour sa muse Misia Sert… Ravel va alors plonger au plus profond de lui-même pour créer son oeuvre universelle, le Bolero");
        $movie_bolero->setEnable(true);
        $movie_bolero->addGenre($genre_biopic);
        $movie_bolero->addMedia($media_bolero);
        $movie_bolero->setMovieStock(new MovieStock());
        $manager->persist($movie_bolero);

        $media_anatomie = new Media();
        $media_anatomie->setName("affiche");
        $media_anatomie->setPath("https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcRlgIE6nCgrEqMH0nQ7r6ssEzZChjlZwVs20bqxC3u9qzFa9mWR");
        $media_anatomie->setType($type_Media_png);

        $movie_anatomie  = new Movie();
        $movie_anatomie->setName("Anatomie d'une chute");
        $movie_anatomie->setDateSortie(\DateTimeImmutable::createFromFormat('j-M-Y', '26-Aug-2024'));
        $movie_anatomie->setSummary("Sandra, Samuel et leur fils malvoyant de 11 ans, Daniel, vivent depuis un an loin de tout, à la montagne. Un jour, Samuel est retrouvé mort au pied de leur maison. Une enquête pour mort suspecte est ouverte. Sandra est bientôt inculpée malgré le doute : suicide ou homicide ? Un an plus tard, Daniel assiste au procès de sa mère, véritable dissection du couple.");
        $movie_anatomie->setEnable(true);
        https: //fr.web.img6.acsta.net/c_310_420/o_club-allocine-2024-310x420.png_0_se/pictures/24/03/01/10/28/1051187.jpg
        $movie_anatomie->addGenre($genre_drame);
        $movie_anatomie->addMedia($media_anatomie);
        $movie_anatomie->setMovieStock(new MovieStock());
        $manager->persist($movie_anatomie);

        $media_restedemain = new Media();
        $media_restedemain->setName("affiche");
        $media_restedemain->setPath("https://fr.web.img3.acsta.net/c_310_420/pictures/24/01/04/15/30/4203338.jpg");
        $media_restedemain->setType($type_Media_png);
        $movie_restedemain  = new Movie();
        $movie_restedemain->setName("Il reste encore demain");
        $movie_restedemain->setDateSortie(\DateTimeImmutable::createFromFormat('j-M-Y', '13-Mar-2024'));
        $movie_restedemain->setSummary("Mariée à un homme autoritaire et violent, Delia, mère de trois enfants, vit à Rome dans la seconde moitié des années 40. L'arrivée d'une lettre mystérieuse va tout bouleverser et pousser Delia à trouver le courage d'imaginer un avenir meilleur, et pas seulement pour elle-même.");
        $movie_restedemain->addGenre($genre_comedy);
        $movie_restedemain->setEnable(true);
        $movie_restedemain->addMedia($media_restedemain);
        $movie_restedemain->setMovieStock(new MovieStock());
        $manager->persist($movie_restedemain);

        $media_heureuxgagnants = new Media();
        $media_heureuxgagnants->setName("affiche");
        $media_heureuxgagnants->setPath("https://fr.web.img6.acsta.net/c_310_420/pictures/24/01/17/11/50/4118109.jpg");
        $media_heureuxgagnants->setType($type_Media_png);
        $movie_heureuxgagnants  = new Movie();
        $movie_heureuxgagnants->setName("Heureux gagnants");
        $movie_heureuxgagnants->setDateSortie(\DateTimeImmutable::createFromFormat('j-M-Y', '13-Mar-2024'));
        $movie_heureuxgagnants->setSummary("1 chance sur 19 millions. Plus de probabilité d'être frappé par une météorite que de gagner au loto. Pour nos heureux gagnants, le rêve va rapidement se transformer en cauchemar, et leur vie va voler en éclat dans un spectaculaire feu d'artifices de comédie noire et de sensations fortes. .");
        $movie_heureuxgagnants->setEnable(true);
        $movie_heureuxgagnants->addGenre($genre_comedy);
        $movie_heureuxgagnants->addMedia($media_heureuxgagnants);
        $movie_heureuxgagnants->setMovieStock(new MovieStock());
        $manager->persist($movie_heureuxgagnants);

        // 
        // Users
        $user = new Utilisateur();
        $user->setEmail("john@doe.fr")
            ->setPassword($this->passwordEncoder->hashPassword($user, '0000'))
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $manager->flush();
        $user_fabien_admin = new Utilisateur();
        $user_fabien_admin->setEmail("fabien@admin");
        $user_fabien_admin->setRoles(['ROLE_ADMIN']);
        $user_fabien_admin->setPassword($this->passwordEncoder
            ->hashPassword(
                $user_fabien_admin,
                "1 2 3 Nous irons au bois !"
            ));
        $manager->persist($user_fabien_admin);

        $manager->flush();
    }
}
