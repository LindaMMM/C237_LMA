<?php

namespace App\Services;

use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class BasketServices
{
    private $requestStack;
    private $repoMovie;

    public function __construct(RequestStack $requestStack, MovieRepository $repomovie)
    {
        $this->requestStack = $requestStack;
        $this->repoMovie = $repomovie;
    }

    public function addToBasket($id)
    {
        $basket = $this->getBasket();
        if (isset($basket[$id])) {
            //produit déjà dans le panier on incrémente
            $basket[$id]++;
        } else {
            //produit pas encore dans le panier on ajoute
            $basket[$id] = 1;
        }
        return $this->updateBasket($basket);
    }

    public function deleteFromBasket($id)
    {
        $basket = $this->getBasket();
        //si produit déjà dans le panier 
        if (isset($basket[$id])) {
            //si il y a plus d'une fois le produit dans le panier on décrémente
            if ($basket[$id] > 1) {
                $basket[$id]--;
            } else {
                //Sinon on supprime
                unset($basket[$id]);
            }
            //on met à jour la session
            $this->updateBasket($basket);
        }
    }

    public function deleteAllToBasket($id)
    {
        $basket = $this->getBasket();
        //si produit(s) déjà dans le panier 
        if (isset($basket[$id])) {
            //on supprime
            unset($basket[$id]);
        }
        //on met à jour la session
        $this->updateBasket($basket);
    }

    public function deleteBasket()
    {
        //on supprime tous les produits (on vide le panier)
        $this->updateBasket([]);
    }

    public function updateBasket($basket)
    {
        $this->requestStack->getSession()->set('basket', $basket);
    }

    public function getBasket()
    {
        $session = $this->requestStack->getSession();
        return $session->get('basket', []);
    }

    public function getFullBasket()
    {
        $basket = $this->getBasket();
        $fullBasket = [];
        foreach ($basket as $id => $quantity) {
            $movie = $this->repoMovie->find($id);
            if ($movie) {
                //produit récupéré avec succés
                $fullBasket[] = [
                    'quantity' => $quantity,
                    'movie' => $movie
                ];
            } else {
                //id incorrect
                $this->deleteFromBasket($id); //on ne met pas à jour la session car cette method le fait aussi (voir plus haut dans la fonction deleteFromCart)
            }
        }
    }
}
