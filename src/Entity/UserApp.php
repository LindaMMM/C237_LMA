<?php

namespace App\Entity;

use App\Repository\UserAppRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserAppRepository::class)]
class UserApp
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $FirstName = null;

    #[ORM\Column(length: 50)]
    private ?string $LastName = null;

    #[ORM\Column(length: 100)]
    private ?string $Email = null;

    #[ORM\Column(length: 255)]
    private ?string $PassworHash = null;

    #[ORM\ManyToMany(targetEntity: RoleApp::class)]
    private Collection $Roles;

    public function __construct($firstname, $lastname, $email, $passwordhash, $role)
    {   
        $this->Roles = new ArrayCollection(); 
        $this->setFirstName($firstname);
        $this->setLastName($lastname);
        $this->setEmail($email);
        $this->setPassworHash($passwordhash);
        $this->addRole($role);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): static
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): static
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPassworHash(): ?string
    {
        return $this->PassworHash;
    }

    public function setPassworHash(string $PassworHash): static
    {
        $this->PassworHash = $PassworHash;

        return $this;
    }

    /**
     * @return Collection<int, RoleApp>
     */
    public function getRoles(): Collection
    {
        return $this->Roles;
    }

    public function addRole(RoleApp $role): static
    {
        if (!$this->Roles->contains($role)) {
            $this->Roles->add($role);
        }

        return $this;
    }

    public function removeRole(RoleApp $role): static
    {
        $this->Roles->removeElement($role);

        return $this;
    }

}
