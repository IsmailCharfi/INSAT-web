<?php

namespace App\Entity;

use App\Repository\FiliereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FiliereRepository::class)
 */
class Filiere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filiere;

    /**
     * @ORM\Column(type="integer")
     */
    private $ordre;

    /**
     * @ORM\OneToMany(targetEntity=MatiereNiveauFiliere::class, mappedBy="filiere", orphanRemoval=true)
     */
    private $matiereNiveauFilieres;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="filiere", orphanRemoval=true)
     */
    private $etudiants;

    /**
     * @ORM\ManyToMany(targetEntity=Niveau::class, inversedBy="filieres")
     */
    private $niveaux;

    public function __construct()
    {
        $this->matiereNiveauFilieres = new ArrayCollection();
        $this->etudiants = new ArrayCollection();
        $this->niveaux = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFiliere(): ?string
    {
        return $this->filiere;
    }

    public function setFiliere(string $filiere): self
    {
        $this->filiere = $filiere;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * @return Collection|MatiereNiveauFiliere[]
     */
    public function getMatiereNiveauFilieres(): Collection
    {
        return $this->matiereNiveauFilieres;
    }

    public function addMatiereNiveauFiliere(MatiereNiveauFiliere $matiereNiveauFiliere): self
    {
        if (!$this->matiereNiveauFilieres->contains($matiereNiveauFiliere)) {
            $this->matiereNiveauFilieres[] = $matiereNiveauFiliere;
            $matiereNiveauFiliere->setFiliere($this);
        }

        return $this;
    }

    public function removeMatiereNiveauFiliere(MatiereNiveauFiliere $matiereNiveauFiliere): self
    {
        if ($this->matiereNiveauFilieres->removeElement($matiereNiveauFiliere)) {
            // set the owning side to null (unless already changed)
            if ($matiereNiveauFiliere->getFiliere() === $this) {
                $matiereNiveauFiliere->setFiliere(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants[] = $etudiant;
            $etudiant->setFiliere($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiants->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getFiliere() === $this) {
                $etudiant->setFiliere(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Niveau[]
     */
    public function getNiveaux(): Collection
    {
        return $this->niveaux;
    }

    public function addNiveau(Niveau $niveau): self
    {
        if (!$this->niveaux->contains($niveau)) {
            $this->niveaux[] = $niveau;
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        $this->niveaux->removeElement($niveau);

        return $this;
    }
}
