<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Adresse;
use App\Entity\Livre;

/**
 * @ORM\Entity(repositoryClass=PersonneRepository::class)
 */
class Personne
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateNaiss;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pwd;
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Adresse",cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private Adresse $adresse;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Livre",cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $livres;

    /**
     * @ORM\OneToMany(targetEntity=AchatProduits::class, mappedBy="personne",cascade={"persist"})
     */
    private $achatProduits;

    public function __construct()
    {
        $this->livres = new ArrayCollection();
        $this->achatProduits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaiss(): ?\DateTimeInterface
    {
        return $this->dateNaiss;
    }

    public function setDateNaiss(?\DateTimeInterface $dateNaiss): self
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPwd(): ?string
    {
        return $this->pwd;
    }

    public function setPwd(string $pwd): self
    {
        $this->pwd = $pwd;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|Livre[]
     */
    public function getLivres(): Collection
    {
        return $this->livres;
    }

    public function addLivre(Livre $livre): self
    {
        if (!$this->livres->contains($livre)) {
            $this->livres[] = $livre;
        }

        return $this;
    }

    public function removeLivre(Livre $livre): self
    {
        $this->livres->removeElement($livre);

        return $this;
    }

    /**
     * @return Collection|AchatProduits[]
     */
    public function getAchatProduits(): Collection
    {
        return $this->achatProduits;
    }

    public function addAchatProduit(AchatProduits $achatProduit): self
    {
        if (!$this->achatProduits->contains($achatProduit)) {
            $this->achatProduits[] = $achatProduit;
            $achatProduit->setPersonne($this);
        }

        return $this;
    }

    public function removeAchatProduit(AchatProduits $achatProduit): self
    {
        if ($this->achatProduits->removeElement($achatProduit)) {
            // set the owning side to null (unless already changed)
            if ($achatProduit->getPersonne() === $this) {
                $achatProduit->setPersonne(null);
            }
        }

        return $this;
    }

   
}
