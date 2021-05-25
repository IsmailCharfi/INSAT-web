<?php

namespace App\Entity;

use App\Repository\EnseignantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnseignantRepository::class)
 */
class Enseignant extends User
{

    /**
     * @ORM\ManyToOne(targetEntity=Departement::class, inversedBy="enseignants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $departement;

    /**
     * @ORM\OneToMany(targetEntity=FicheNotes::class, mappedBy="enseignant", orphanRemoval=true)
     */
    private $ficheNotes;

    public function __construct()
    {
        $this->ficheNotes = new ArrayCollection();
    }


    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * @return Collection|FicheNotes[]
     */
    public function getFicheNotes(): Collection
    {
        return $this->ficheNotes;
    }

    public function addFicheNote(FicheNotes $ficheNote): self
    {
        if (!$this->ficheNotes->contains($ficheNote)) {
            $this->ficheNotes[] = $ficheNote;
            $ficheNote->setEnseignant($this);
        }

        return $this;
    }

    public function removeFicheNote(FicheNotes $ficheNote): self
    {
        if ($this->ficheNotes->removeElement($ficheNote)) {
            // set the owning side to null (unless already changed)
            if ($ficheNote->getEnseignant() === $this) {
                $ficheNote->setEnseignant(null);
            }
        }

        return $this;
    }
}
