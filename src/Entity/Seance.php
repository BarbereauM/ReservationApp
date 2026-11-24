<?php

namespace App\Entity;

use App\Repository\SeanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeanceRepository::class)]
class Seance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_seance = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_debut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_fin = null;

    #[ORM\Column]
    private ?int $capacite = null;

    #[ORM\Column]
    private ?bool $statut = null;

    #[ORM\Column(length: 255)]
    private ?string $motif_annulation = null;

    #[ORM\ManyToOne(inversedBy: 'seances')]
    private ?Entraineur $animer = null;

    #[ORM\ManyToOne(inversedBy: 'seances')]
    private ?Activite $comporter = null;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'prevoir')]
    private Collection $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSeance(): ?int
    {
        return $this->id_seance;
    }

    public function setIdSeance(int $id_seance): static
    {
        $this->id_seance = $id_seance;

        return $this;
    }

    public function getDateDebut(): ?\DateTime
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTime $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTime
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTime $date_fin): static
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): static
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function isStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getMotifAnnulation(): ?string
    {
        return $this->motif_annulation;
    }

    public function setMotifAnnulation(string $motif_annulation): static
    {
        $this->motif_annulation = $motif_annulation;

        return $this;
    }

    public function getAnimer(): ?Entraineur
    {
        return $this->animer;
    }

    public function setAnimer(?Entraineur $animer): static
    {
        $this->animer = $animer;

        return $this;
    }

    public function getComporter(): ?Activite
    {
        return $this->comporter;
    }

    public function setComporter(?Activite $comporter): static
    {
        $this->comporter = $comporter;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setPrevoir($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getPrevoir() === $this) {
                $reservation->setPrevoir(null);
            }
        }

        return $this;
    }
}
