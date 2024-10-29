<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PaymentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['payment:read']],
    denormalizationContext: ['groups' => ['payment:write']],
)]
class Payment
{
    const PAYMENT_RECEIVED = 'Payment received';
    const PAYMENT_AWAITING = 'Awaiting for payment';
    const PAYMENT_PARTIALLY_MADE = 'Partially paid';
    const PAYMENT_METHOD_CASH = 'Cash';
    const PAYMENT_METHOD_BANK_TRANSFER = 'Bank transfer';
    const PAYMENT_METHOD_CREDIT_CARD = 'Credit Card';
    const PAYMENT_METHOD_PAYME = 'Payme';
    const PAYMENT_METHOD_CLICK = 'Click';
    const PAYMENT_METHOD_UZUM_BANK = 'Uzum Bank';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['payment:read'])]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'payment', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['payment:read', 'payment:write'])]
    private ?Order $order = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['payment:read'])]
    private ?\DateTimeInterface $paymentDate = null;

    #[ORM\Column]
    #[Groups(['payment:read', 'payment:write'])]
    private ?float $amountPaid = null;

    #[ORM\Column(length: 255)]
    #[Groups(['payment:read', 'payment:write'])]
    private ?string $paymentMethod = null;

    #[ORM\Column(length: 255)]
    #[Groups(['payment:read', 'payment:write'])]
    private ?string $paymentStatus = null;

    #[ORM\Column]
    #[Groups(['payment:read'])]
    private ?float $balanceDue = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['payment:read', 'payment:write'])]
    private ?string $notes = null; // set on edit action

    #[ORM\Column]
    #[Groups(['payment:read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['payment:read'])]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'payments')]
    #[Groups(['payment:read'])]
    private ?Customer $customer = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Currency $currency = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTime();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderId(): ?Order
    {
        return $this->order;
    }

    public function setOrderId(Order $orderId): static
    {
        $this->order = $orderId;

        return $this;
    }

    public function getPaymentDate(): ?\DateTimeInterface
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(?\DateTimeInterface $paymentDate): static
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    public function getAmountPaid(): ?float
    {
        return $this->amountPaid;
    }

    public function setAmountPaid(float $amountPaid): static
    {
        $this->amountPaid = $amountPaid;

        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(string $paymentMethod): static
    {
        if (!in_array($paymentMethod, [
            Payment::PAYMENT_METHOD_CASH,
            Payment::PAYMENT_METHOD_CLICK,
            Payment::PAYMENT_METHOD_BANK_TRANSFER,
            Payment::PAYMENT_METHOD_CREDIT_CARD,
            Payment::PAYMENT_METHOD_PAYME,
            Payment::PAYMENT_METHOD_UZUM_BANK
        ]))
        {
            throw new \InvalidArgumentException('Invalid payment method');
        }

        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function getPaymentStatus(): ?string
    {
        return $this->paymentStatus;
    }

    public function setPaymentStatus(string $paymentStatus): static
    {
        if (!in_array($paymentStatus, [
                PAYMENT::PAYMENT_RECEIVED,
                PAYMENT::PAYMENT_AWAITING,
                PAYMENT::PAYMENT_PARTIALLY_MADE
            ])) {
            throw new \InvalidArgumentException('Invalid payment status');
        }

        $this->paymentStatus = $paymentStatus;

        return $this;
    }

    public function getBalanceDue(): ?float
    {
        return $this->balanceDue;
    }

    public function setBalanceDue(float $balanceDue): static
    {
        $this->balanceDue = $balanceDue;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

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

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

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
}
