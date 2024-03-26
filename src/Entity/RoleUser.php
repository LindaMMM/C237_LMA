<?php

namespace App\Entity;

use App\Repository\RoleUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleUserRepository::class)]
class RoleUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'Role')]
    #[ORM\JoinColumn(nullable: false)]
    private ?UserApp $User = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?RoleApp $Role = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?UserApp
    {
        return $this->User;
    }

    public function setUser(?UserApp $User): static
    {
        $this->User = $User;

        return $this;
    }

    public function getRole(): ?RoleApp
    {
        return $this->Role;
    }

    public function setRole(?RoleApp $Role): static
    {
        $this->Role = $Role;

        return $this;
    }
}
