<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: GenreRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_GENRE', fields: ['name'])]
#[UniqueEntity(fields: ['name'], message: 'Ce nom existe déjà.')]
class Genre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Type("string")]
    #[Assert\NotBlank(message: "Le nom ne peut pas être vide")]
    #[Assert\Length(
        max: 50,
        maxMessage: "Le nom doit compter au plus {{ limit }} caractères.",
        min: 2,
        minMessage: "Le nom doit compter au moins {{ limit }} caractères."
    )]
    #[Assert\Regex(
        pattern: '/\w+/',
        match: true,
        message: "Le nom n'a pas le bon format.",
    )]

    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function __construct()
    {
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
