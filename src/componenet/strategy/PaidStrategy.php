<?php

namespace App\componenet\strategy;

use App\componenet\interface\PayrollStrategyInterface;
use App\Entity\SalaryReport;

class PaidStrategy implements PayrollStrategyInterface
{
    public function process(SalaryReport $salaryReport, ?float $paidSalaryAmount): void
    {
        $netSalary = $salaryReport->getNetSalary();
        $salaryReport->setPaidSalaryAmount($netSalary);
        $salaryReport->setRemainingSalaryAmount(0);
    }
}