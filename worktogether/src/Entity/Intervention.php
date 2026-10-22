<?php

namespace App\Entity;

use App\Enum\TypeIntervention;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'intervention')]
class Intervention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', enumType: TypeIntervention::class)]
    private TypeIntervention $type;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $dateDebut;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $dateFin = null;

    #[ORM\OneToMany(targetEntity: InterventionUnite::class, mappedBy: 'intervention', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $interventionsUnites;

    public function __construct()
    {
        $this->interventionsUnites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): TypeIntervention
    {
        return $this->type;
    }

    public function setType(TypeIntervention $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDateDebut(): \DateTimeImmutable
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeImmutable $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeImmutable
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeImmutable $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * @return Collection<int, InterventionUnite>
     */
    public function getInterventionsUnites(): Collection
    {
        return $this->interventionsUnites;
    }

    public function addInterventionsUnite(InterventionUnite $interventionsUnite): static
    {
        if (!$this->interventionsUnites->contains($interventionsUnite)) {
            $this->interventionsUnites->add($interventionsUnite);
            $interventionsUnite->setIntervention($this);
        }

        return $this;
    }

    public function removeInterventionsUnite(InterventionUnite $interventionsUnite): static
    {
        $this->interventionsUnites->removeElement($interventionsUnite);

        return $this;
    }
}
