<?php

namespace App\Component\Interfaces;

use App\Entity\SalaryReport;

interface PayrollStrategyInterface
{
    public function process(SalaryReport $salaryReport, ?float $paidSalaryAmount): void;
}