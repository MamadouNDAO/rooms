<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtudiantRepository", repositoryClass=EtudiantRepository::class)
 */
class Etudiant
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
    private $matricule;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Le champs ne doit pas etre vide")
     * @Assert\Length(
     * min = 2,
     * max = 15,
     * minMessage = "Votre nom doit contenir au moins {{limit}} caractères",
     * maxMessage = "Votre nom ne doit pas dépasser les {{limit}} caractères ",
     * allowEmptyString = false
     * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Le champs ne doit pas etre vide")
     * @Assert\Length(
     * min = 2,
     * max = 15,
     * minMessage = "Votre nom doit contenir au moins {{limit}} caractères",
     * maxMessage = "Votre nom ne doit pas dépasser les {{limit}} caractères ",
     * allowEmptyString = false
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Le champs ne doit pas etre vide")
     * @Assert\Email(
     * message = "E-mail non valide."
     * )
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $departement;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le champs ne doit pas être vide.")
     * @Assert\Regex("/^[7][0|7|8|6]([0-9]{7})$/", message="N° de telephone non valide")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type_etudiant;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $type_bourse;

    /**
     * @ORM\ManyToOne(targetEntity=Chambre::class, inversedBy="etudiants")
     */
    private $num_chambre;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $status;


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getTypeEtudiant(): ?string
    {
        return $this->type_etudiant;
    }

    public function setTypeEtudiant(string $type_etudiant): self
    {
        $this->type_etudiant = $type_etudiant;

        return $this;
    }

    public function getTypeBourse(): ?string
    {
        return $this->type_bourse;
    }

    public function setTypeBourse(?string $type_bourse): self
    {
        $this->type_bourse = $type_bourse;

        return $this;
    }

    public function getNumChambre(): ?Chambre
    {
        return $this->num_chambre;
    }

    public function setNumChambre(?Chambre $num_chambre): self
    {
        $this->num_chambre = $num_chambre;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
