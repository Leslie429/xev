<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
#[Broadcast]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private ?int $note = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $appréciation = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'avis')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'avis')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Produit $produit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    // 🚀 Ajout d'un constructeur pour initialiser la date automatiquement
    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
    }

    public function getNote(): ?int
    {
        return $this->note;
    }
    
    public function setNote(int $note): static
    {
        $this->note = $note;
        return $this;
    }
    

    public function getAppréciation(): ?string
    {
        return $this->appréciation;
    }

    public function setAppréciation(?string $appréciation): static
    {
        $this->appréciation = $appréciation;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeImmutable $created_at): static
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

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }


    // 🚀 Nouveau : Getter pour formater la date
    public function getFormattedDate(): string
    {
        return $this->created_at ? $this->created_at->format('d/m/Y H:i') : 'Non spécifié';
    }

}
