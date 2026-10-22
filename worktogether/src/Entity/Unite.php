<?php

namespace App\Entity;

use App\Enum\EtatUnite;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'unite')]
class Unite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 3)]
    private string $position;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $couleur = null;

    #[ORM\Column(type: 'string', enumType: EtatUnite::class)]
    private EtatUnite $etat;

    #[ORM\ManyToOne(targetEntity: Baie::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Baie $baie;

    #[ORM\OneToMany(targetEntity: InterventionUnite::class, mappedBy: 'unite', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $interventionsUnites;

    public function __construct()
    {
        $this->interventionsUnites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function setPosition(string $position): static
    {
        if (1 !== preg_match('/^U[0-9]{2}$/', $position)) {
            throw new \InvalidArgumentException('La position doit respecter le format UXX (ex. U01).');
        }

        $this->position = $position;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(?string $couleur): static
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getEtat(): EtatUnite
    {
        return $this->etat;
    }

    public function setEtat(EtatUnite $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getBaie(): Baie
    {
        return $this->baie;
    }

    public function setBaie(Baie $baie): static
    {
        $this->baie = $baie;

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
            $interventionsUnite->setUnite($this);
        }

        return $this;
    }

    public function removeInterventionsUnite(InterventionUnite $interventionsUnite): static
    {
        $this->interventionsUnites->removeElement($interventionsUnite);

        return $this;
    }
}
