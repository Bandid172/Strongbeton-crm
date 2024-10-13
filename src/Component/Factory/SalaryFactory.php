<?php

namespace App\Component\Factory;

use App\Entity\Employee;
use App\Entity\SalaryReport;
use App\Services\SalaryCalculator;
use App\Services\SalaryPayrollStrategy;
use Exception;

class SalaryFactory
{
    /**
     * @throws Exception
     */
    public function create(
        float $baseSalary,
        string $payPeriod,
        ?\DateTimeInterface $payDate,
        string $currency,
        ?int $bonuses,
        ?int $deductions,
        string $taxInformation,
        string $salaryType,
        string $paymentMethod,
        string $payrollStatus,
        ?string $notes,
        ?float $paidSalaryAmount,
        ?Employee $employee
    ): SalaryReport
    {
        $salaryReport = new SalaryReport();

        $salaryReport
            ->setBaseSalary($baseSalary)
            ->setPayPeriod($payPeriod)
            ->setpayDate($payDate)
            ->setCurrency($currency)
            ->setbonuses($bonuses)
            ->setDeductions($deductions)
            ->setTaxInformation($taxInformation)
            ->setSalaryType($salaryType)
            ->setPaymentMethod($paymentMethod)
            ->setPayrollStatus($payrollStatus)
            ->setNotes($notes)
            ->setEmployee($employee)
            ->setCreatedAt(new \DateTimeImmutable('now', new \DateTimeZone('Asia/Tashkent')))
            ->setUpdatedAt(new \DateTime('now', new \DateTimeZone('Asia/Tashkent')));

            SalaryCalculator::calculateSalaryAndTax($salaryReport);

        $strategy = SalaryPayrollStrategy::getPayrollStrategy($payrollStatus);
        $strategy->process($salaryReport, $paidSalaryAmount);

        return $salaryReport;
    }
}