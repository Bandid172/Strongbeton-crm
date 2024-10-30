<?php

namespace App\Component\Factory;

use App\Entity\Currency;
use App\Entity\Inflow;

class InflowFactory
{
    public function create(
        \DateTimeInterface $transactionDate,
        string $revenueSource,
        float $amount,
        string $paymentMethod,
        string $notes,
        Currency $currency
    ): Inflow
    {
        $inflow = new Inflow();

        $inflow
            ->setTransactionDate($transactionDate)
            ->setRevenueSource($revenueSource)
            ->setAmount($amount)
            ->setCurrency($currency)
            ->setPaymentMethod($paymentMethod)
            ->setNotes($notes);

        return $inflow;
    }
}