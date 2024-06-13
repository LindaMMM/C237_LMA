<?php

namespace App\Entity;

use App\Repository\MovieStockRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieStockRepository::class)]
class MovieStock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'movieStock', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Movie $movie = null;

    #[ORM\Column]
    private ?int $stockIn = null;

    #[ORM\Column]
    private ?int $stockOut = null;

    #[ORM\Column]
    private ?int $stockReserved = null;

    public function __construct()
    {
        $this->setStockIn(0);
        $this->setStockOut(0);
        $this->setStockReserved(0);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function setMovie(Movie $movie): static
    {
        $this->movie = $movie;

        return $this;
    }

    public function getStockIn(): ?int
    {
        return $this->stockIn;
    }

    public function setStockIn(int $stockIn): static
    {
        $this->stockIn = $stockIn;

        return $this;
    }

    public function getStockOut(): ?int
    {
        return $this->stockOut;
    }

    public function setStockOut(int $stockOut): static
    {
        $this->stockOut = $stockOut;

        return $this;
    }

    public function getStockReserved(): ?int
    {
        return $this->stockReserved;
    }

    public function setStockReserved(int $stockReserved): static
    {
        $this->stockReserved = $stockReserved;

        return $this;
    }
}
