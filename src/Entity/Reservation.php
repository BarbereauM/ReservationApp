<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_reservation = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\Column]
    private ?bool $rappel_envoye = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Utilisateur $preparer = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Seance $prevoir = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReservation(): ?\DateTime
    {
        return $this->date_reservation;
    }

    public function setDateReservation(\DateTime $date_reservation): static
    {
        $this->date_reservation = $date_reservation;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function isRappelEnvoye(): ?bool
    {
        return $this->rappel_envoye;
    }

    public function setRappelEnvoye(bool $rappel_envoye): static
    {
        $this->rappel_envoye = $rappel_envoye;

        return $this;
    }

    public function getPreparer(): ?Utilisateur
    {
        return $this->preparer;
    }

    public function setPreparer(?Utilisateur $preparer): static
    {
        $this->preparer = $preparer;

        return $this;
    }

    public function getPrevoir(): ?Seance
    {
        return $this->prevoir;
    }

    public function setPrevoir(?Seance $prevoir): static
    {
        $this->prevoir = $prevoir;

        return $this;
    }
}
