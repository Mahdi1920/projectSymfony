<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\Column(length: 20)]
    private ?string $nce = null;

    #[ORM\Column(length: 20)]
    private ?string $nom = null;

    #[ORM\Column(length: 20)]
    private ?string $dsecription = null;

    #[ORM\Column]
    private ?float $kilom = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?Showroom $showroom = null;

    public function getNce(): ?string
    {
        return $this->nce;
    }

    public function setNce(string $nce): self
    {
        $this->nce = $nce;

        return $this;
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

    public function getDsecription(): ?string
    {
        return $this->dsecription;
    }

    public function setDsecription(string $dsecription): self
    {
        $this->dsecription = $dsecription;

        return $this;
    }

    public function getKilom(): ?float
    {
        return $this->kilom;
    }

    public function setKilom(float $kilom): self
    {
        $this->kilom = $kilom;

        return $this;
    }

    public function getShowroom(): ?Showroom
    {
        return $this->showroom;
    }

    public function setShowroom(?Showroom $showroom): self
    {
        $this->showroom = $showroom;

        return $this;
    }
}
