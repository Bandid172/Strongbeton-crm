<?php

namespace App\Component\custom;

use App\Component\Interfaces\PayrollStrategyInterface;
use App\Entity\SalaryReport;

class PendingStrategy implements PayrollStrategyInterface
{
    public function process(SalaryReport $salaryReport, ?float $paidSalaryAmount): void
    {
        $netSalary = $salaryReport->getNetSalary();
        $salaryReport->setPaidSalaryAmount($paidSalaryAmount);
        $salaryReport->setRemainingSalaryAmount($netSalary - $paidSalaryAmount);
    }
}