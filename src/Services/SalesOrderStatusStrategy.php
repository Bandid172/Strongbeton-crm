<?php

namespace App\Services;

use App\Entity\Order;

class SalesOrderStatusStrategy
{
    public static function getSalesOrderStatus(string $status): string
    {
        return match ($status) {
            'Pending' => Order::SALES_ORDER_PENDING,
            'Confirmed' => Order::SALES_ORDER_CONFIRMED,
            'Processing' => Order::SALES_ORDER_PROCESSING,
            'On Hold' => Order::SALES_ORDER_ON_HOLD,
            'Cancelled' => Order::SALES_ORDER_CANCELLED,
            'Completed' => Order::SALES_ORDER_COMPLETED,
            default => throw new \InvalidArgumentException("Invalid order status: $status"),
        };
    }
}
