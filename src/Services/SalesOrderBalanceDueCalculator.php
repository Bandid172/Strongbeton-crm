<?php

namespace App\Services;

class SalesOrderBalanceDueCalculator
{
    public static function calculateBalanceDue(float $totalAmount, float $paidAmount): float
    {
        return $totalAmount - $paidAmount;
    }
}
