<?php

namespace App\Services;

use App\Entity\Product;

class SalesOrderCalculateSubTotal
{
    public static function calculateTotal(Product $orderItem, int $totalQuantity): float
    {
        $price = $orderItem->getPricePerUnit();

        return $price * $totalQuantity;
    }
}
