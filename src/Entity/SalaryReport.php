<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\SalaryCreateAction;
use App\Repository\SalaryReportRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: SalaryReportRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new Post(
            uriTemplate: '/salary-reports',
            controller: SalaryCreateAction::class,
            name: 'create_salary_report'
        ),
        new GetCollection(),
        new Put(),
        new Delete(),
        new Patch()
    ],
    normalizationContext: ['groups' => ['salaryReport:read']],
    denormalizationContext: ['groups' => ['salaryReport:write']]
)]
class SalaryReport
{
    const SALARY_STATUS_PAID = 'Paid';
    const SALARY_STATUS_PENDING = 'Partially Paid';
    const SALARY_STATUS_UNPAID = 'Not Paid';
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['salaryReport:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['salaryReport:read', 'salaryReport:write'])]
    private ?string $payPeriod = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['salaryReport:read'])]
    private ?\DateTimeInterface $payDate = null;

    #[ORM\Column(length: 255)]
    #[Groups(['salaryReport:read', 'salaryReport:write'])]
    private ?string $currency = null; //

    #[ORM\Column]
    #[Groups(['salaryReport:read', 'salaryReport:write'])]
    private ?float $grossSalary = null;

    #[ORM\Column]
    #[Groups(['salaryReport:read'])]
    private ?float $netSalary = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['salaryReport:read', 'salaryReport:write'])]
    private ?int $bonuses = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['salaryReport:read', 'salaryReport:write'])]
    private ?int $deductions = null;

    #[ORM\Column(length: 255)]
    #[Groups(['salaryReport:read', 'salaryReport:write'])]
    private ?string $taxInformation = null; //

    #[ORM\Column]
    #[Groups(['salaryReport:read'])]
    private ?float $taxPercentage = 12;

    #[ORM\Column]
    #[Groups(['salaryReport:read'])]
    private ?float $taxAmount = null;

    #[ORM\Column(length: 255)]
    #[Groups(['salaryReport:read', 'salaryReport:write'])]
    private ?string $salaryType = null; //

    #[ORM\Column(length: 255)]
    #[Groups(['salaryReport:read', 'salaryReport:write'])]
    private ?string $paymentMethod = null; //

    #[ORM\Column(length: 255)]
    #[Groups(['salaryReport:read'])]
    private ?string $payrollStatus = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['salaryReport:read', 'salaryReport:write'])]
    private ?string $notes = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['salaryReport:read', 'salaryReport:write'])]
    private ?float $paidSalaryAmount = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['salaryReport:read'])]
    private ?float $remainingSalaryAmount = null;

    #[ORM\ManyToOne]
    #[Groups(['salaryReport:read', 'salaryReport:write'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employee $employee = null;

    #[ORM\Column]
    #[Groups(['salaryReport:read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['salaryReport:read'])]
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

    public function getPayPeriod(): ?string
    {
        return $this->payPeriod;
    }

    public function setPayPeriod(string $payPeriod): static
    {
        $this->payPeriod = $payPeriod;

        return $this;
    }

    public function getPayDate(): ?\DateTimeInterface
    {
        return $this->payDate;
    }

    public function setPayDate(?\DateTimeInterface $payDate): static
    {
        $this->payDate = $payDate;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getGrossSalary(): ?float
    {
        return $this->grossSalary;
    }

    public function setGrossSalary(float $grossSalary): static
    {
        $this->grossSalary = $grossSalary;
        $this->calculateTaxAndNetSalary();
        return $this;
    }

    public function getNetSalary(): ?float
    {
        return $this->netSalary;
    }

    public function setNetSalary(float $netSalary): static
    {
        $this->netSalary = $netSalary;

        return $this;
    }

    public function getBonuses(): ?int
    {
        return $this->bonuses;
    }

    public function setBonuses(?int $bonuses): static
    {
        $this->bonuses = $bonuses;
        $this->calculateTaxAndNetSalary();
        return $this;
    }

    public function getDeductions(): ?int
    {
        return $this->deductions;
    }

    public function setDeductions(?int $deductions): static
    {
        $this->deductions = $deductions;
        $this->calculateTaxAndNetSalary();
        return $this;
    }

    public function getTaxInformation(): ?string
    {
        return $this->taxInformation;
    }

    public function setTaxInformation(string $taxInformation): static
    {
        $this->taxInformation = $taxInformation;

        return $this;
    }

    public function getTaxPercentage(): ?float
    {
        return $this->taxPercentage;
    }

    public function setTaxPercentage(float $taxPercentage): static
    {
        $this->taxPercentage = $taxPercentage;
        $this->calculateTaxAndNetSalary();
        return $this;
    }

    public function getTaxAmount(): ?float
    {
        return $this->taxAmount;
    }

    public function setTaxAmount(float $taxAmount): static
    {
        $this->taxAmount = $taxAmount;

        return $this;
    }

    public function getSalaryType(): ?string
    {
        return $this->salaryType;
    }

    public function setSalaryType(string $salaryType): static
    {
        $this->salaryType = $salaryType;

        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(string $paymentMethod): static
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function getPayrollStatus(): ?string
    {
        return $this->payrollStatus;
    }

    public function setPayrollStatus(string $payrollStatus): static
    {
        if (!in_array($payrollStatus, [self::SALARY_STATUS_PAID, self::SALARY_STATUS_PENDING, self::SALARY_STATUS_UNPAID])) {
            throw new \InvalidArgumentException("Invalid payment status");
        }
        $this->payrollStatus = $payrollStatus;

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

    public function getPaidSalaryAmount(): ?float
    {
        return $this->paidSalaryAmount;
    }

    public function setPaidSalaryAmount(float $paidSalaryAmount): static
    {
        if ($paidSalaryAmount > $this->netSalary) {
            throw new \InvalidArgumentException("Paid salary amount must be equal or less than net salary.");
        }

        if ($paidSalaryAmount > 0) {
            $this->payDate = new \DateTime();
        }

        $this->paidSalaryAmount = $paidSalaryAmount;
        $this->setRemainingSalaryAmount();

        return $this;
    }

    public function getRemainingSalaryAmount(): ?float
    {
        return $this->remainingSalaryAmount;
    }

    public function setRemainingSalaryAmount(): static
    {
        $this->remainingSalaryAmount = $this->netSalary - $this->paidSalaryAmount;

        if ($this->remainingSalaryAmount == 0) {
            $this->payrollStatus = self::SALARY_STATUS_PAID;
        } else if ($this->remainingSalaryAmount === $this->netSalary) {
            $this->payrollStatus = self::SALARY_STATUS_UNPAID;
        } else {
            $this->payrollStatus = self::SALARY_STATUS_PENDING;
        }

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): static
    {
        $this->employee = $employee;

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

    public function calculateTaxAndNetSalary(): void
    {
        $this->taxAmount = $this->grossSalary * ($this->taxPercentage / 100);
        $this->netSalary = $this->grossSalary - $this->taxAmount + $this->bonuses - $this->deductions;
    }
}
