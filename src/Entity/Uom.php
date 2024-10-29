<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UomRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UomRepository::class)]
#[ApiResource]
class Uom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
