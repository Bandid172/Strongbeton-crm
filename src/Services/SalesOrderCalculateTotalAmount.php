<?php

namespace App\Services;

class SalesOrderCalculateTotalAmount
{
    public static function calculateTotalAmount(float $subtotal, ?float $discount, ?float $shippingCost): float
    {
        $totalAmount = 0;
        if ($discount !== null && $discount > 0) {
            $totalAmount = $subtotal - $discount;
        }

        if ($shippingCost !== null && $shippingCost > 0) {
            $totalAmount += $shippingCost;
        }

        return $totalAmount;
    }
}
