<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\CustomerCreateAction;
use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/create-customer',
            controller: CustomerCreateAction::class,
            name: 'create_customer'
        ),
        new Get(),
        new GetCollection(),
        new Put(),
        new Delete(),
        new Patch()
    ],
    normalizationContext: ['groups' => ['customer:read']],
    denormalizationContext: ['groups' => ['customer:write']]
)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['customer:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['customer:read', 'customer:write'])]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[Groups(['customer:read', 'customer:write'])]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    #[Groups(['customer:read', 'customer:write'])]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['customer:read', 'customer:write'])]
    private ?string $email = null;

    #[Groups(['customer:read', 'customer:write'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    /**
     * @var Collection<int, Organization>
     */
    #[Groups(['customer:read', 'customer:write'])]
    #[ORM\OneToMany(targetEntity: Organization::class, mappedBy: 'customer')]
    private Collection $organization;

    #[ORM\Column]
    #[Groups(['customer:read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['customer:read'])]
    private ?\DateTimeInterface $updatedAt = null;

    /**
     * @var Collection<int, Order>
     */
    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'customer')]
    #[Groups(['customer:read'])]
    private Collection $orders;

    /**
     * @var Collection<int, Payment>
     */
    #[ORM\OneToMany(targetEntity: Payment::class, mappedBy: 'customer')]
    #[Groups(['customer:read'])]
    private Collection $payments;

    public function __construct()
    {
        $this->organization = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->payments = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

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

    /**
     * @return Collection<int, Organization>
     */
    public function getOrganization(): Collection
    {
        return $this->organization;
    }

    public function addOrganization(Organization $organization): static
    {
        if (!$this->organization->contains($organization)) {
            $this->organization->add($organization);
            $organization->setCustomer($this);
        }

        return $this;
    }

    public function removeOrganization(Organization $organization): static
    {
        if ($this->organization->removeElement($organization)) {
            // set the owning side to null (unless already changed)
            if ($organization->getCustomer() === $this) {
                $organization->setCustomer(null);
            }
        }

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

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setCustomer($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getCustomer() === $this) {
                $order->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Payment>
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function addPayment(Payment $payment): static
    {
        if (!$this->payments->contains($payment)) {
            $this->payments->add($payment);
            $payment->setCustomer($this);
        }

        return $this;
    }

    public function removePayment(Payment $payment): static
    {
        if ($this->payments->removeElement($payment)) {
            // set the owning side to null (unless already changed)
            if ($payment->getCustomer() === $this) {
                $payment->setCustomer(null);
            }
        }

        return $this;
    }
}
