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
     * @ORM\Column(type="string", length=255)
     */
    private $numero;

    /**
     * @ORM\ManyToOne(targetEntity=Batiment::class, inversedBy="chambres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idBatiment;

    /**
     * @ORM\ManyToOne(targetEntity=TypeChambre::class, inversedBy="chambres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idTypeChambre;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="numeroChambre")
     */
    private $etudiants;
    /**
     * @ORM\Column(type="boolean")
     */
    private $statut;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();
    }





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getIdBatiment(): ?Batiment
    {
        return $this->idBatiment;
    }

    public function setIdBatiment(?Batiment $idBatiment): self
    {
        $this->idBatiment = $idBatiment;

        return $this;
    }

    public function getIdTypeChambre(): ?TypeChambre
    {
        return $this->idTypeChambre;
    }

    public function setIdTypeChambre(?TypeChambre $idTypeChambre): self
    {
        $this->idTypeChambre = $idTypeChambre;

        return $this;
    }

    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): self
    {
        $this->statut = $statut;

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
            $etudiant->setNumeroChambre($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiants->contains($etudiant)) {
            $this->etudiants->removeElement($etudiant);
            // set the owning side to null (unless already changed)
            if ($etudiant->getNumeroChambre() === $this) {
                $etudiant->setNumeroChambre(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        return $this->numero;
    }

}
