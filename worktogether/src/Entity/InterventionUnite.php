<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'intervention_unite')]
#[ORM\UniqueConstraint(name: 'uniq_intervention_unite', columns: ['intervention_id', 'unite_id'])]
class InterventionUnite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $notes = null;

    #[ORM\ManyToOne(targetEntity: Intervention::class, inversedBy: 'interventionsUnites')]
    #[ORM\JoinColumn(nullable: false)]
    private Intervention $intervention;

    #[ORM\ManyToOne(targetEntity: Unite::class, inversedBy: 'interventionsUnites')]
    #[ORM\JoinColumn(nullable: false)]
    private Unite $unite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }

    public function getIntervention(): Intervention
    {
        return $this->intervention;
    }

    public function setIntervention(Intervention $intervention): static
    {
        $this->intervention = $intervention;

        return $this;
    }

    public function getUnite(): Unite
    {
        return $this->unite;
    }

    public function setUnite(Unite $unite): static
    {
        $this->unite = $unite;

        return $this;
    }
}
