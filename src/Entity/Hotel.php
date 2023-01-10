<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\GroupeHotelier;
/**
 * @ORM\Entity(repositoryClass=HotelRepository::class)
 */
class Hotel
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
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Adresse;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $Nb_etoile;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $Groupe;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(?string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getNbEtoile(): ?int
    {
        return $this->Nb_etoile;
    }

    public function setNbEtoile(?int $Nb_etoile): self
    {
        $this->Nb_etoile = $Nb_etoile;

        return $this;
    }
    public function getGroupe(): string
    {
        return $this->Groupe;
    }

    public function setGroupe(string $Groupe): self
    {
        $this->Groupe = $Groupe;

        return $this;
    }
}
