<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaiementRepository::class)]
class Paiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $date_paiement = null;

    #[ORM\Column(nullable: true)]
    private ?int $transation_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $charge_id = null;

    #[ORM\Column(length: 255)]
    private ?string $type_paie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDatePaiement(): ?\DateTimeImmutable
    {
        return $this->date_paiement;
    }

    public function setDatePaiement(\DateTimeImmutable $date_paiement): static
    {
        $this->date_paiement = $date_paiement;

        return $this;
    }

    public function getTransationId(): ?int
    {
        return $this->transation_id;
    }

    public function setTransationId(?int $transation_id): static
    {
        $this->transation_id = $transation_id;

        return $this;
    }

    public function getChargeId(): ?int
    {
        return $this->charge_id;
    }

    public function setChargeId(?int $charge_id): static
    {
        $this->charge_id = $charge_id;

        return $this;
    }

    public function getTypePaie(): ?string
    {
        return $this->type_paie;
    }

    public function setTypePaie(string $type_paie): static
    {
        $this->type_paie = $type_paie;

        return $this;
    }
}
