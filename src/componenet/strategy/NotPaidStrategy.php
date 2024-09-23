<?php

namespace App\componenet\strategy;

use App\componenet\interface\PayrollStrategyInterface;
use App\Entity\SalaryReport;

class NotPaidStrategy implements PayrollStrategyInterface
{
    public function process(SalaryReport $salaryReport, ?float $paidSalaryAmount): void
    {
        $netSalary = $salaryReport->getNetSalary();
        $salaryReport->setPaidSalaryAmount(0);
        $salaryReport->setRemainingSalaryAmount($netSalary);
    }
}