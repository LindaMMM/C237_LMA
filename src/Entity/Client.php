<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $Addres = null;

    #[ORM\Column(length: 12)]
    private ?string $Phone = null;

    #[ORM\OneToOne(mappedBy: 'client', cascade: ['persist', 'remove'])]
    private ?Credit $credit = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Utilisateur $user = null;

    #[ORM\OneToMany(targetEntity: Command::class, mappedBy: 'client')]
    private Collection $commands;

    public function __construct()
    {
        $this->commands = new ArrayCollection();
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

    public function getAddres(): ?string
    {
        return $this->Addres;
    }

    public function setAddres(string $Addres): static
    {
        $this->Addres = $Addres;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(string $Phone): static
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getCredit(): ?Credit
    {
        return $this->credit;
    }

    public function setCredit(?Credit $credit): static
    {
        // unset the owning side of the relation if necessary
        if ($credit === null && $this->credit !== null) {
            $this->credit->setClient(null);
        }

        // set the owning side of the relation if necessary
        if ($credit !== null && $credit->getClient() !== $this) {
            $credit->setClient($this);
        }

        $this->credit = $credit;

        return $this;
    }

    public function getUser(): ?Utilisateur
    {
        return $this->user;
    }

    public function setUser(?Utilisateur $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Command>
     */
    public function getCommands(): Collection
    {
        return $this->commands;
    }

    public function addCommand(Command $command): static
    {
        if (!$this->commands->contains($command)) {
            $this->commands->add($command);
            $command->setClient($this);
        }

        return $this;
    }

    public function removeCommand(Command $command): static
    {
        if ($this->commands->removeElement($command)) {
            // set the owning side to null (unless already changed)
            if ($command->getClient() === $this) {
                $command->setClient(null);
            }
        }

        return $this;
    }
}
