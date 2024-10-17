<?php

namespace App\Services;

use App\Component\Interfaces\PayrollStrategyInterface;
use App\Entity\SalaryReport;

class SalaryPayrollStrategy
{
    public static function getPayrollStrategy(string $payrollStatus): PayrollStrategyInterface
    {
        return match ($payrollStatus) {
            SalaryReport::SALARY_STATUS_PAID => new PaidStrategy(),
            SalaryReport::SALARY_STATUS_PENDING => new PendingStrategy(),
            SalaryReport::SALARY_STATUS_UNPAID => new NotPaidStrategy(),
            default => throw new \InvalidArgumentException("Invalid payroll status: $payrollStatus"),
        };
    }
}
