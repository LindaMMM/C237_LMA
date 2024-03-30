<?php

namespace App\Entity;

use App\Repository\TypeCreditRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeCreditRepository::class)]
class TypeCredit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Name = null;

    #[ORM\Column]
    private ?float $Prix = null;

    #[ORM\Column]
    private ?int $NbCredit = null;

    #[ORM\Column]
    private ?bool $Enable = null;

    public function __construct($name, $nbcredit, $price)
    {
        $this->setName($name);
        $this->setNbCredit($nbcredit);
        $this->setPrix($price);
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(float $Prix): static
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getNbCredit(): ?int
    {
        return $this->NbCredit;
    }

    public function setNbCredit(int $NbCredit): static
    {
        $this->NbCredit = $NbCredit;

        return $this;
    }

    public function isEnable(): ?bool
    {
        return $this->Enable;
    }

    public function setEnable(bool $Enable): static
    {
        $this->Enable = $Enable;

        return $this;
    }
}
