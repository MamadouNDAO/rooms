<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChambreRepository::class)
 */
class Chambre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $num_chambre;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type_chambre;

    /**
     * @ORM\Column(type="integer")
     */
    private $num_batiment;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="num_chambre")
     */
    private $etudiants;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumChambre(): ?string
    {
        return $this->num_chambre;
    }

    public function setNumChambre(string $num_chambre): self
    {
        $this->num_chambre = $num_chambre;

        return $this;
    }

    public function getTypeChambre(): ?string
    {
        return $this->type_chambre;
    }

    public function setTypeChambre(string $type_chambre): self
    {
        $this->type_chambre = $type_chambre;

        return $this;
    }

    public function getNumBatiment(): ?int
    {
        return $this->num_batiment;
    }

    public function setNumBatiment(int $num_batiment): self
    {
        $this->num_batiment = $num_batiment;

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
            $etudiant->setNumChambre($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiants->contains($etudiant)) {
            $this->etudiants->removeElement($etudiant);
            // set the owning side to null (unless already changed)
            if ($etudiant->getNumChambre() === $this) {
                $etudiant->setNumChambre(null);
            }
        }

        return $this;
    }
}
