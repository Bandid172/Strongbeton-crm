<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\OrderCreateAction;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/create-order',
            controller: OrderCreateAction::class,
            name: 'create_order',
        ),
        new Get(),
        new GetCollection(),
        new Put(),
        new Delete(),
        new Patch()
    ],
    normalizationContext: ['groups' => ['order:read']],
    denormalizationContext: ['groups' => ['order:write']]
)]
class Order
{
    const SALES_ORDER_PENDING = 'Pending';
    const SALES_ORDER_CONFIRMED = 'Confirmed';
    const SALES_ORDER_PROCESSING = 'Processing';
    const SALES_ORDER_ON_HOLD = 'On Hold';
    const SALES_ORDER_CANCELLED = 'Cancelled';
    const SALES_ORDER_COMPLETED = 'Completed';
    const SALES_ORDER_DELIVERED = 'Delivered';
    const SALES_ORDER_ENROUTE = 'Enroute';
    const SALES_ORDER_DELIVERY_PENDING = 'Awaiting Shipment';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['order:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['order:read'])]
    private ?string $orderNumber = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['order:read', 'order:write'])]
    private ?Customer $customer = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['order:read', 'order:write'])]
    private ?\DateTimeInterface $orderDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['order:read'])]
    private ?\DateTimeInterface $deliveryDate = null; // estimated delivery time (will not be implemented yet)

    #[ORM\Column(length: 255)]
    #[Groups(['order:read', 'order:write'])]
    private ?string $status = null;

    #[ORM\Column(length: 255)]
    #[Groups(['order:read', 'order:write'])] //
    private ?string $paymentStatus = null;

    #[ORM\Column(length: 255)]
    #[Groups(['order:read', 'order:write'])]
    private ?string $shippingAddress = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['order:read', 'order:write'])]
    private ?Product $orderItem = null;

    #[ORM\Column]
    #[Groups(['order:read', 'order:write'])]
    private ?int $totalQuantity = null;

    #[ORM\Column]
    #[Groups('order:read')]
    private ?float $subTotal = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['order:read', 'order:write'])]
    private ?float $discount = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['order:read', 'order:write'])]
    private ?float $shippingCost = null;

    #[ORM\Column(length: 255)]
    #[Groups(['order:read', 'order:write'])]
    private ?string $paymentMethod = null;

    #[ORM\Column]
    #[Groups(['order:read', 'order:write'])]
    private ?float $paidAmount = null;

    #[ORM\Column]
    #[Groups(['order:read'])]
    private ?float $balanceDue = null;

    #[ORM\Column(length: 255)]
    #[Groups(['order:read', 'order:write'])]
    private ?string $deliveryStatus = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['order:read'])] // when status is changed to completed
    private ?\DateTimeInterface $shippedDate = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['order:read', 'order:write'])]
    private ?Employee $salesRepresentative = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['order:read', 'order:write'])]
    private ?string $notes = null;

    #[ORM\Column]
    #[Groups(['order:read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['order:read'])]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\OneToOne(mappedBy: 'order', cascade: ['persist', 'remove'])]
    #[Groups(['order:read'])]
    private ?Payment $payment = null;

    /**
     * @var Collection<int, Vehicle>
     */
    #[ORM\ManyToMany(targetEntity: Vehicle::class, inversedBy: 'orders')]
    #[Groups(['order:read', 'order:write'])]
    private Collection $vehicle;

    #[ORM\Column(nullable: true)]
    #[Groups(['order:read', 'order:write'])]
    private ?bool $shippingRequired = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['order:read', 'order:write'])]
    private ?Currency $currency = null;

    public function __construct()
    {
        $this->vehicle = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \Datetime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderNumber(): ?string
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(): static
    {
        $this->orderNumber = 'S000' . random_int(1, 99999);;

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

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): static
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(?\DateTimeInterface $deliveryDate): static
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        if (!in_array($status, [
            self::SALES_ORDER_PENDING,
            self::SALES_ORDER_CONFIRMED,
            self::SALES_ORDER_PROCESSING,
            self::SALES_ORDER_ON_HOLD,
            self::SALES_ORDER_CANCELLED,
            self::SALES_ORDER_COMPLETED
        ]))
        {
            throw new \InvalidArgumentException('Invalid order status');
        }

        $this->status = $status;

        return $this;
    }

    public function getPaymentStatus(): ?string
    {
        return $this->paymentStatus;
    }

    public function setPaymentStatus(string $paymentStatus): static
    {
        if (!in_array($paymentStatus, [Payment::PAYMENT_AWAITING, Payment::PAYMENT_RECEIVED, Payment::PAYMENT_PARTIALLY_MADE]))
        {
            throw new \InvalidArgumentException('Invalid payment status');
        }
        $this->paymentStatus = $paymentStatus;

        return $this;
    }

    public function getShippingAddress(): ?string
    {
        return $this->shippingAddress;
    }

    public function setShippingAddress(string $shippingAddress): static
    {
        $this->shippingAddress = $shippingAddress;

        return $this;
    }

    public function getOrderItem(): ?Product
    {
        return $this->orderItem;
    }

    public function setOrderItem(?Product $orderItem): static
    {
        $this->orderItem = $orderItem;
        $this->setSubTotal();

        return $this;
    }

    public function getTotalQuantity(): ?int
    {
        return $this->totalQuantity;
    }

    public function setTotalQuantity(int $totalQuantity): static
    {
        $this->totalQuantity = $totalQuantity;
        $this->setSubTotal();

        return $this;
    }

    public function getSubTotal(): ?float
    {
        return $this->subTotal;
    }

    public function setSubTotal(): static
    {
        $this->subTotal = $this->totalQuantity * $this->orderItem->getPricePerUnit();

        if ($this->shippingRequired && $this->shippingCost > 0) {
            $this->subTotal += $this->shippingCost;
        }

        if ($this->discount !== null && $this->discount > 0) {
            $this->subTotal -= $this->discount;
        }

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(?float $discount): static
    {
        $this->discount = $discount;
        $this->setSubTotal();

        return $this;
    }

    public function getShippingCost(): ?float
    {
        return $this->shippingCost;
    }

    public function setShippingCost(?float $shippingCost): static
    {
        $this->shippingCost = $shippingCost;
        $this->setSubTotal();

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

    public function getPaidAmount(): ?float
    {
        return $this->paidAmount;
    }

    public function setPaidAmount(float $paidAmount): static
    {
        $this->setSubTotal();

        if ($paidAmount > $this->subTotal) {
            throw new \InvalidArgumentException("Paid amount must be equal or less than subtotal.");
        }

        $this->paidAmount = $paidAmount;
        $this->setBalanceDue();

        return $this;
    }

    public function getBalanceDue(): ?float
    {
        return $this->balanceDue;
    }

    public function setBalanceDue(): static
    {
        $this->balanceDue = $this->subTotal - $this->paidAmount;

        return $this;
    }

    public function getExpectedDeliveryDate(): ?\DateTimeInterface
    {
        return $this->expectedDeliveryDate;
    }

    public function setExpectedDeliveryDate(?\DateTimeInterface $expectedDeliveryDate): static
    {
        $this->expectedDeliveryDate = $expectedDeliveryDate;

        return $this;
    }

    public function getDeliveryStatus(): ?string
    {
        return $this->deliveryStatus;
    }

    public function setDeliveryStatus(string $deliveryStatus): static
    {
        if (!in_array($deliveryStatus, [
            Order::SALES_ORDER_DELIVERY_PENDING,
            Order::SALES_ORDER_ENROUTE,
            Order::SALES_ORDER_DELIVERED
        ]))
        {
            throw new \InvalidArgumentException('Invalid delivery status');
        }
        $this->deliveryStatus = $deliveryStatus;

        return $this;
    }

    public function getShippedDate(): ?\DateTimeInterface
    {
        return $this->shippedDate;
    }

    public function setShippedDate(?\DateTimeInterface $shippedDate): static
    {
        $this->shippedDate = $shippedDate;

        return $this;
    }

    public function getSalesRepresentative(): ?Employee
    {
        return $this->salesRepresentative;
    }

    public function setSalesRepresentative(?Employee $salesRepresentative): static
    {
        $this->salesRepresentative = $salesRepresentative;

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

    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    public function setPayment(Payment $payment): static
    {
        // set the owning side of the relation if necessary
        if ($payment->getOrderId() !== $this) {
            $payment->setOrderId($this);
        }

        $this->payment = $payment;

        return $this;
    }

    /**
     * @return Collection<int, Vehicle>
     */
    public function getVehicle(): Collection
    {
        return $this->vehicle;
    }

    public function addVehicle(Vehicle $vehicle): static
    {
        if (!$this->vehicle->contains($vehicle)) {
            $this->vehicle->add($vehicle);
        }

        return $this;
    }

    public function removeVehicle(Vehicle $vehicle): static
    {
        $this->vehicle->removeElement($vehicle);

        return $this;
    }

    public function isShippingRequired(): ?bool
    {
        return $this->shippingRequired;
    }

    public function setShippingRequired(?bool $shippingRequired): static
    {
        $this->shippingRequired = $shippingRequired;

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
