<?php

namespace App\Services;

use App\Entity\Payment;

class PaymentStatusStrategy
{
    public static function getPaymentStatus(string $paymentStatus): string
    {
        return match ($paymentStatus) {
            'Payment received' => Payment::PAYMENT_RECEIVED,
            'Awaiting for payment' => Payment::PAYMENT_AWAITING,
            'Partially paid' => Payment::PAYMENT_PARTIALLY_MADE,
            default => throw new \InvalidArgumentException("Invalid payment status: $paymentStatus"),
        };
    }
}
