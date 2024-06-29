<?php

namespace App\DTO;

class AddCredit
{

    private int $quantite = 0;

    public function __construct()
    {
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }
}
