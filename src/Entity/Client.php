<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '^(\d{1,4})\s?(bis|ter(?=))?\s(rue|avenue|boulevard|allee|chemin)\s(([[:alpha:]]+\s){1,4})(\d{5})\s(([[:alpha:]]+){1,4})',
        match: true,
        message: "L'adresse n'est pas valide",
    )]
    private ?string $lastName = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '^(\d{1,4})\s?(bis|ter(?=))?\s(rue|avenue|boulevard|allee|chemin)\s(([[:alpha:]]+\s){1,4})(\d{5})\s(([[:alpha:]]+){1,4})',
        match: true,
        message: "L'adresse n'est pas valide",
    )]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '^(\d{1,4})\s?(bis|ter(?=))?\s(rue|avenue|boulevard|allee|chemin)\s(([[:alpha:]]+\s){1,4})(\d{5})\s(([[:alpha:]]+){1,4})',
        match: true,
        message: "L'adresse n'est pas valide",
    )]
    private ?string $addres = null;

    #[ORM\Column(length: 12)]
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '^(0|\+33)([1-7]{1})[0-9]{8}',
        match: true,
        message: "Le numéro ne respecte pas le format des numéros.",
    )]
    private ?string $Phone = null;

    #[ORM\OneToOne(mappedBy: 'client', cascade: ['persist', 'remove'])]
    private ?Credit $credit = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Utilisateur $user = null;

    #[ORM\OneToMany(targetEntity: Command::class, mappedBy: 'client')]
    private Collection $commands;


    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateBirth = null;

    #[ORM\Column]
    private ?bool $enable = true;

    public function __construct()
    {
        $this->commands = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $Name): static
    {
        $this->lastName = $Name;

        return $this;
    }

    public function getAddres(): ?string
    {
        return $this->addres;
    }

    public function setAddres(string $Addres): static
    {
        $this->addres = $Addres;

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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $FirstName): static
    {
        $this->firstName = $FirstName;

        return $this;
    }

    public function getDateBirth(): ?\DateTimeInterface
    {
        return $this->dateBirth;
    }

    public function setDateBirth(\DateTimeInterface $DateBirth): static
    {
        $this->dateBirth = $DateBirth;

        return $this;
    }

    public function isEnable(): ?bool
    {
        return $this->enable;
    }

    public function setEnable(?bool $enable): static
    {
        $this->enable = $enable;

        return $this;
    }
}
