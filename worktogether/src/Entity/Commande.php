<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'commande')]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 191, unique: true)]
    private string $reference;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $dateCommande;

    #[ORM\Column(length: 20)]
    private string $periodicite;

    #[ORM\Column]
    private bool $taciteReconduction = false;

    #[ORM\Column(length: 255)]
    private string $statut;

    #[ORM\ManyToOne(targetEntity: Client::class, cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private Client $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDateCommande(): \DateTimeImmutable
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeImmutable $dateCommande): static
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getPeriodicite(): string
    {
        return $this->periodicite;
    }

    public function setPeriodicite(string $periodicite): static
    {
        if (!in_array($periodicite, ['mensuel', 'annuel'], true)) {
            throw new \InvalidArgumentException('La périodicité doit être "mensuel" ou "annuel".');
        }

        $this->periodicite = $periodicite;

        return $this;
    }

    public function isTaciteReconduction(): bool
    {
        return $this->taciteReconduction;
    }

    public function setTaciteReconduction(bool $taciteReconduction): static
    {
        $this->taciteReconduction = $taciteReconduction;

        return $this;
    }

    public function getStatut(): string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): static
    {
        $this->client = $client;

        return $this;
    }
}
