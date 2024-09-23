<?php

namespace App\componenet\interface;

use App\Entity\SalaryReport;

interface PayrollStrategyInterface
{
    public function process(SalaryReport $salaryReport, ?float $paidSalaryAmount): void;
}