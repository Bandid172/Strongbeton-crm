<?php

namespace App\Component\Factory;

use App\Entity\Currency;
use App\Entity\Employee;
use App\Entity\SalaryReport;
use Exception;

class SalaryFactory
{
    /**
     * @throws Exception
     */
    public function create(
        float $grossSalary,
        string $payPeriod,
        Currency $currency,
        ?int $bonuses,
        ?int $deductions,
        string $taxInformation,
        string $salaryType,
        string $paymentMethod,
        ?string $notes,
        ?float $paidSalaryAmount,
        ?Employee $employee
    ): SalaryReport
    {
        $salaryReport = new SalaryReport();

        $salaryReport
            ->setGrossSalary($grossSalary)
            ->setPayPeriod($payPeriod)
            ->setCurrency($currency)
            ->setbonuses($bonuses)
            ->setDeductions($deductions)
            ->setTaxInformation($taxInformation)
            ->setSalaryType($salaryType)
            ->setPaymentMethod($paymentMethod)
            ->setNotes($notes)
            ->setPaidSalaryAmount($paidSalaryAmount)
            ->setEmployee($employee);

        return $salaryReport;
    }
}