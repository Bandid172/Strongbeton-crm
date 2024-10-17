<?php

namespace App\Services;

use App\Entity\Payment;

class PaymentMethodStrategy
{
    public static function getPaymentMethod(string $paymentMethod): string
    {
        return match ($paymentMethod) {
            'Cash' => Payment::PAYMENT_METHOD_CASH,
            'Bank Transfer' => Payment::PAYMENT_METHOD_BANK_TRANSFER,
            'Credit Card' => Payment::PAYMENT_METHOD_CREDIT_CARD,
            'Payme' => Payment::PAYMENT_METHOD_PAYME,
            'Click' => Payment::PAYMENT_METHOD_CLICK,
            'Uzum Bank' => Payment::PAYMENT_METHOD_UZUM_BANK,
            default => throw new \InvalidArgumentException("Unknown payment method: $paymentMethod"),
        };
    }
}