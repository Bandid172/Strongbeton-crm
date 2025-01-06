<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\ProductCreateAction;
use App\Repository\ProductRepository;
use App\Repository\ResourceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/create-product',
            controller: ProductCreateAction::class,
            name: 'create_product'
        ),
        new Get(),
        new GetCollection(),
        new Put(),
        new Delete(),
        new Patch()
    ],
    normalizationContext: ['groups' => ['product:read']],
    denormalizationContext: ['groups' => ['product:write']]
)]
class Product
{
    const IN_STOCK = 'In Stock';
    const OUT_OF_STOCK = 'Out Of Stock';
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['product:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['product:read', 'product:write'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['product:read', 'product:write'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?bool $enabled = null;

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?float $pricePerUnit = null;

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?float $costPerUnit = null;

    #[ORM\Column]
    #[Groups(['product:read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['product:read'])]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column]
    #[Groups(['product:read'])]
    private ?int $stockQuantity = null;

    #[ORM\Column(length: 255)]
    #[Groups(['product:read'])]
    private ?string $inventoryStatus = null;

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?float $requiredSandAmount = null;

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?float $requiredCementAmount = null;

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?float $requiredWaterAmount = null;

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?float $requiredStoneAmount = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['product:read', 'product:write'])]
    private ?Currency $currency = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['product:read', 'product:write'])]
    private ?Uom $uom = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTime();
    }
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): static
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getPricePerUnit(): ?float
    {
        return $this->pricePerUnit;
    }

    public function setPricePerUnit(float $pricePerUnit): static
    {
        $this->pricePerUnit = $pricePerUnit;

        return $this;
    }

    public function getCostPerUnit(): ?float
    {
        return $this->costPerUnit;
    }

    public function setCostPerUnit(float $costPerUnit): static
    {
        $this->costPerUnit = $costPerUnit;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getStockQuantity(): ?int
    {
        return $this->stockQuantity;
    }

    public function setStockQuantity(int $stockQuantity): static
    {
        $this->stockQuantity = $stockQuantity;

        return $this;
    }

    public function getInventoryStatus(): ?string
    {
        return $this->inventoryStatus;
    }

    public function setInventoryStatus(): static
    {
        if ($this->getStockQuantity() > 0) {
            $this->inventoryStatus = self::IN_STOCK;
        } else {
            $this->inventoryStatus = self::OUT_OF_STOCK;
        }

        return $this;
    }

    public function getRequiredSandAmount(): ?float
    {
        return $this->requiredSandAmount;
    }

    public function setRequiredSandAmount(float $requiredSandAmount): static
    {
        $this->requiredSandAmount = $requiredSandAmount;

        return $this;
    }

    public function getRequiredCementAmount(): ?float
    {
        return $this->requiredCementAmount;
    }

    public function setRequiredCementAmount(float $requiredCementAmount): static
    {
        $this->requiredCementAmount = $requiredCementAmount;

        return $this;
    }

    public function getRequiredWaterAmount(): ?float
    {
        return $this->requiredWaterAmount;
    }

    public function setRequiredWaterAmount(float $requiredWaterAmount): static
    {
        $this->requiredWaterAmount = $requiredWaterAmount;

        return $this;
    }

    public function getRequiredStoneAmount(): ?float
    {
        return $this->requiredStoneAmount;
    }

    public function setRequiredStoneAmount(float $requiredStoneAmount): static
    {
        $this->requiredStoneAmount = $requiredStoneAmount;

        return $this;
    }

    public function getCurrency(): ?Currency
    {
        return $this->currency;
    }

    public function setCurrency(?Currency $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getUom(): ?Uom
    {
        return $this->uom;
    }

    public function setUom(?Uom $uom): static
    {
        $this->uom = $uom;

        return $this;
    }

    /**
     * @throws Exception
     */
    public function calculateStockQuantity(ResourceRepository $resourceRepository): int
    {
        $requiredResources = [
            'sand' => $this->getRequiredSandAmount(),
            'cement' => $this->getRequiredCementAmount(),
            'water' => $this->getRequiredWaterAmount(),
            'stone' => $this->getRequiredStoneAmount(),
        ];

        $capacities = [];
        foreach ($requiredResources as $resourceName => $requiredAmount) {
            $resource = $resourceRepository->findOneBy(['name' => $resourceName]);
            if (!$resource) {
                throw new Exception("Resource {$resourceName} is not available.");
            }
            $capacities[] = $resource->calculateCapacity($requiredAmount);
        }

        $this->setStockQuantity(min($capacities));
        $this->setInventoryStatus();

        return $this->getStockQuantity();
    }
}
