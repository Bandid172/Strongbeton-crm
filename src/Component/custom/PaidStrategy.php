<?php

namespace App\Component\custom;

use App\Component\Interfaces\PayrollStrategyInterface;
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