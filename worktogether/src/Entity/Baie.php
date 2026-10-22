<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'baie')]
class Baie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 4, unique: true)]
    private string $code;

    #[ORM\Column(options: ['default' => 42])]
    private int $hauteurU = 42;

    #[ORM\Column(length: 255)]
    private string $localisation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        if (1 !== preg_match('/^B[0-9]{3}$/', $code)) {
            throw new \InvalidArgumentException('Le code de la baie doit respecter le format BXXX (ex. B001).');
        }

        $this->code = $code;

        return $this;
    }

    public function getHauteurU(): int
    {
        return $this->hauteurU;
    }

    public function setHauteurU(int $hauteurU): static
    {
        $this->hauteurU = $hauteurU;

        return $this;
    }

    public function getLocalisation(): string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): static
    {
        $this->localisation = $localisation;

        return $this;
    }
}
