<?php

namespace App\Entity;

use App\Repository\EtudiantSearchRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtudiantSearchRepository::class)
 */
class EtudiantSearch
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $departement;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $typeEtudiant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getTypeEtudiant(): ?string
    {
        return $this->typeEtudiant;
    }

    public function setTypeEtudiant(string $typeEtudiant): self
    {
        $this->typeEtudiant = $typeEtudiant;

        return $this;
    }
}
