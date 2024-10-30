<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\CurrencyCreateAction;
use App\Repository\CurrencyRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/create-currency',
            controller: CurrencyCreateAction::class,
            name: 'create_currency',
        ),
        new Get(),
        new GetCollection(),
        new Put(),
        new Delete(),
        new Patch()
    ],
    normalizationContext: ['groups' => ['currency:read']],
    denormalizationContext: ['groups' => ['currency:write']],
)]
class Currency
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['currency:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['currency:read', 'currency:write'])]
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
