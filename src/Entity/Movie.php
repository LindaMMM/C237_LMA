<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: MovieRepository::class)]
#[UniqueEntity(fields: ['name'], message: 'Ce film existe déjà.')]
class Movie
{
    const STATUS_ACTIF = true;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\Type("string")]
    #[Assert\NotBlank(message: "Le nom ne peut pas être vide")]
    #[Assert\Length(
        max: 100,
        maxMessage: "Le nom doit compter au plus {{ limit }} caractères.",
        min: 2,
        minMessage: "Le nom doit compter au moins {{ limit }} caractères."
    )]
    private ?string $name = null;

    #[ORM\Column(length: 2000)]
    #[Assert\Type("string")]
    #[Assert\NotBlank(message: "La description ne peut pas être vide")]
    #[Assert\Length(
        max: 2000,
        maxMessage: "La description doit compter au plus {{ limit }} caractères.",
        min: 2,
        minMessage: "La description doit compter au moins {{ limit }} caractères."
    )]
    private ?string $summary = null;

    #[ORM\OneToMany(targetEntity: Media::class, mappedBy: 'movie', cascade: ['persist', 'remove'])]
    #[Assert\Valid]
    private Collection $medias;

    #[ORM\OneToOne(mappedBy: 'movie', cascade: ['persist', 'remove'])]
    private ?MovieStock $movieStock = null;

    #[ORM\OneToMany(targetEntity: Emprunt::class, mappedBy: 'movie')]
    private Collection $emprunts;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\LessThan('today')]
    private ?\DateTimeInterface $dateSortie = null;

    #[ORM\ManyToMany(targetEntity: "Genre")]
    #[ORM\JoinTable(name: "movie_genre")]
    #[ORM\JoinColumn(name: "movie_id", referencedColumnName: "id")]
    #[ORM\InverseJoinColumn(name: "genre_id", referencedColumnName: "id")]
    private Collection $genres;

    #[ORM\Column]
    private bool $enable = true;

    public function __construct()
    {
        $this->medias = new ArrayCollection();
        $this->emprunts = new ArrayCollection();
        $this->genres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): static
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    public function addMedia(Media $media): static
    {
        if (!$this->medias->contains($media)) {
            $this->medias->add($media);
            $media->setMovie($this);
        }

        return $this;
    }

    public function removeMedia(Media $media): static
    {
        if ($this->medias->removeElement($media)) {
            // set the owning side to null (unless already changed)
            if ($media->getMovie() === $this) {
                $media->setMovie(null);
            }
        }

        return $this;
    }

    public function getMovieStock(): ?MovieStock
    {
        return $this->movieStock;
    }

    public function setMovieStock(MovieStock $movieStock): static
    {
        // set the owning side of the relation if necessary
        if ($movieStock->getMovie() !== $this) {
            $movieStock->setMovie($this);
        }

        $this->movieStock = $movieStock;

        return $this;
    }

    /**
     * @return Collection<int, Emprunt>
     */
    public function getEmprunts(): Collection
    {
        return $this->emprunts;
    }

    public function addEmprunt(Emprunt $emprunt): static
    {
        if (!$this->emprunts->contains($emprunt)) {
            $this->emprunts->add($emprunt);
            $emprunt->setMovie($this);
        }

        return $this;
    }

    public function removeEmprunt(Emprunt $emprunt): static
    {
        if ($this->emprunts->removeElement($emprunt)) {
            // set the owning side to null (unless already changed)
            if ($emprunt->getMovie() === $this) {
                $emprunt->setMovie(null);
            }
        }

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->dateSortie;
    }

    public function setDateSortie(\DateTimeInterface $dateSortie): static
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }

    /**
     * @return Collection<int, genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(genre $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
        }

        return $this;
    }

    public function removeGenre(genre $genre): static
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    public function isEnable(): bool
    {
        return $this->enable;
    }

    public function setEnable(bool $enable): static
    {
        $this->enable = $enable;

        return $this;
    }
}
