<?php

namespace App\Entity;

use App\Repository\EntraineurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntraineurRepository::class)]
class Entraineur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_entraineur = null;

    #[ORM\Column(length: 255)]
    private ?string $specialite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $biographie = null;

    #[ORM\Column(length: 255)]
    private ?string $Encadrer = null;

    /**
     * @var Collection<int, Activite>
     */
    #[ORM\ManyToMany(targetEntity: Activite::class, inversedBy: 'entraineurs')]
    private Collection $encadrer;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Utilisateur $etre = null;

    /**
     * @var Collection<int, Seance>
     */
    #[ORM\OneToMany(targetEntity: Seance::class, mappedBy: 'animer')]
    private Collection $seances;

    public function __construct()
    {
        $this->encadrer = new ArrayCollection();
        $this->seances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEntraineur(): ?int
    {
        return $this->id_entraineur;
    }

    public function setIdEntraineur(int $id_entraineur): static
    {
        $this->id_entraineur = $id_entraineur;

        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): static
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getBiographie(): ?string
    {
        return $this->biographie;
    }

    public function setBiographie(?string $biographie): static
    {
        $this->biographie = $biographie;

        return $this;
    }

    public function getEncadrer(): ?string
    {
        return $this->Encadrer;
    }

    public function setEncadrer(string $Encadrer): static
    {
        $this->Encadrer = $Encadrer;

        return $this;
    }

    public function addEncadrer(Activite $encadrer): static
    {
        if (!$this->encadrer->contains($encadrer)) {
            $this->encadrer->add($encadrer);
        }

        return $this;
    }

    public function removeEncadrer(Activite $encadrer): static
    {
        $this->encadrer->removeElement($encadrer);

        return $this;
    }

    public function getEtre(): ?Utilisateur
    {
        return $this->etre;
    }

    public function setEtre(?Utilisateur $etre): static
    {
        $this->etre = $etre;

        return $this;
    }

    /**
     * @return Collection<int, Seance>
     */
    public function getSeances(): Collection
    {
        return $this->seances;
    }

    public function addSeance(Seance $seance): static
    {
        if (!$this->seances->contains($seance)) {
            $this->seances->add($seance);
            $seance->setAnimer($this);
        }

        return $this;
    }

    public function removeSeance(Seance $seance): static
    {
        if ($this->seances->removeElement($seance)) {
            // set the owning side to null (unless already changed)
            if ($seance->getAnimer() === $this) {
                $seance->setAnimer(null);
            }
        }

        return $this;
    }
}
