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
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 2000)]
    private ?string $Summary = null;

    #[ORM\OneToMany(targetEntity: Media::class, mappedBy: 'movie', cascade: ['persist', 'remove'])]
    #[Assert\Valid]
    private Collection $medias;

    #[ORM\OneToOne(mappedBy: 'movie', cascade: ['persist', 'remove'])]
    private ?MovieStock $movieStock = null;

    #[ORM\OneToMany(targetEntity: Emprunt::class, mappedBy: 'movie')]
    private Collection $emprunts;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateSortie = null;

    #[ORM\ManyToMany(targetEntity: "Genre")]
    #[ORM\JoinTable(name: "movie_genre")]
    #[ORM\JoinColumn(name: "movie_id", referencedColumnName: "id")]
    #[ORM\InverseJoinColumn(name: "genre_id", referencedColumnName: "id")]
    private Collection $genres;

    #[ORM\Column]
    private ?bool $Enable = null;

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

    public function setName(string $Name): static
    {
        $this->name = $Name;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->Summary;
    }

    public function setSummary(string $Summary): static
    {
        $this->Summary = $Summary;

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
        return $this->DateSortie;
    }

    public function setDateSortie(\DateTimeInterface $DateSortie): static
    {
        $this->DateSortie = $DateSortie;

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
