<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\OutflowCreateAction;
use App\Repository\OutflowRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: OutflowRepository::class)]
#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/create-outflow',
            controller: OutflowCreateAction::class,
            name: 'create_outflow',
        ),
        new Get(),
        new GetCollection(),
        new Put(),
        new Delete(),
        new Patch()
    ],
    normalizationContext: ['groups' => ['outflow:read']],
    denormalizationContext: ['groups' => ['outflow:write']],
)]
class Outflow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['outflow:read'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['outflow:read', 'outflow:write'])]
    private ?\DateTimeInterface $transactionDate = null;

    #[ORM\Column(length: 255)]
    #[Groups(['outflow:read', 'outflow:write'])]
    private ?string $expenseCategory = null;

    #[ORM\Column]
    #[Groups(['outflow:read', 'outflow:write'])]
    private ?float $amount = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['outflow:read', 'outflow:write'])]
    private ?string $currency = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['outflow:read', 'outflow:write'])]
    private ?string $paymentMethod = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['outflow:read', 'outflow:write'])]
    private ?string $expenseDescription = null;

    #[ORM\Column]
    #[Groups(['outflow:read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['outflow:read'])]
    private ?\DateTimeInterface $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTime();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransactionDate(): ?\DateTimeInterface
    {
        return $this->transactionDate;
    }

    public function setTransactionDate(\DateTimeInterface $transactionDate): static
    {
        $this->transactionDate = $transactionDate;

        return $this;
    }

    public function getExpenseCategory(): ?string
    {
        return $this->expenseCategory;
    }

    public function setExpenseCategory(string $expenseCategory): static
    {
        $this->expenseCategory = $expenseCategory;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(?string $paymentMethod): static
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function getExpenseDescription(): ?string
    {
        return $this->expenseDescription;
    }

    public function setExpenseDescription(string $expenseDescription): static
    {
        $this->expenseDescription = $expenseDescription;

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

    public function setUpdatedAt(\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
