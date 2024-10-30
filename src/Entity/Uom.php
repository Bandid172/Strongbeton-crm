<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\UomCreateAction;
use App\Repository\UomRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: UomRepository::class)]
#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/create-uom',
            controller: UomCreateAction::class,
            name: 'create_uom'
        ),
        new Get(),
        new GetCollection(),
        new Put,
        new Delete(),
        new Patch()
    ],
    normalizationContext: ['groups' => ['uom:read']],
    denormalizationContext: ['groups' => ['uom:write']],
)]
class Uom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['uom:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['uom:read', 'uom:write'])]
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
