<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'offre')]
class Offre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $nom;

    #[ORM\Column]
    private int $nombreUnites;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private string $prixMensuel;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2)]
    private string $remiseAnnuelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNombreUnites(): int
    {
        return $this->nombreUnites;
    }

    public function setNombreUnites(int $nombreUnites): static
    {
        $this->nombreUnites = $nombreUnites;

        return $this;
    }

    public function getPrixMensuel(): string
    {
        return $this->prixMensuel;
    }

    public function setPrixMensuel(string $prixMensuel): static
    {
        $this->prixMensuel = $prixMensuel;

        return $this;
    }

    public function getRemiseAnnuelle(): string
    {
        return $this->remiseAnnuelle;
    }

    public function setRemiseAnnuelle(string $remiseAnnuelle): static
    {
        $this->remiseAnnuelle = $remiseAnnuelle;

        return $this;
    }
}
