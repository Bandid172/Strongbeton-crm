<?php

namespace App\Services;

use App\Entity\SalaryReport;

class SalaryCalculator
{
    public static function calculateSalaryAndTax(SalaryReport $salaryReport, float $taxPercentage = 12): SalaryReport
    {
        $grossSalary = $salaryReport->getBaseSalary();
        $taxAmount = ($grossSalary * $taxPercentage) / 100;
        $netSalary = ($grossSalary - $taxAmount - $salaryReport->getDeductions()) + $salaryReport->getBonuses();

        $salaryReport->setGrossSalary($grossSalary);
        $salaryReport->setNetSalary($netSalary);
        $salaryReport->setTaxPercentage($taxPercentage);
        $salaryReport->setTaxAmount($taxAmount);

        return $salaryReport;
    }
}
