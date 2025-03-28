<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[Broadcast]
class Commande
{
    // Constantes pour les statuts
    public const STATUT_EN_ATTENTE = 'en_attente';
    public const STATUT_EN_COURS = 'en_cours';
    public const STATUT_LIVREE = 'livree';
    public const STATUT_ANNULEE = 'annulee';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $adr_livr = null;

    #[ORM\Column(length: 20)]
    private ?string $statut_com = self::STATUT_EN_ATTENTE;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?User $user = null;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\ManyToMany(targetEntity: Produit::class, mappedBy: 'commande')]
    private Collection $produits;

    #[ORM\ManyToOne(inversedBy: 'commande')]
    #[ORM\JoinColumn(nullable: true)]
    private ?ProdCom $prodCom = null;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable(); // Définit la date de création automatiquement
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getAdrLivr(): ?string
    {
        return $this->adr_livr;
    }

    public function setAdrLivr(string $adr_livr): static
    {
        $this->adr_livr = $adr_livr;

        return $this;
    }

    public function getStatutCom(): ?string
    {
        return $this->statut_com;
    }

    public function setStatutCom(string $statut_com): static
    {
        // Valider que la valeur est correcte
        if (!in_array($statut_com, [self::STATUT_EN_ATTENTE, self::STATUT_EN_COURS, self::STATUT_LIVREE, self::STATUT_ANNULEE])) {
            throw new \InvalidArgumentException('Statut non valide');
        }

        $this->statut_com = $statut_com;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->addCommande($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            $produit->removeCommande($this);
        }

        return $this;
    }

    public function getProdCom(): ?ProdCom
    {
        return $this->prodCom;
    }

    public function setProdCom(?ProdCom $prodCom): static
    {
        $this->prodCom = $prodCom;

        return $this;
    }
}
