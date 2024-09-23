<?php

namespace App\componenet\strategy;

use App\componenet\interface\PayrollStrategyInterface;
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