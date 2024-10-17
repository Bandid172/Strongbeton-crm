<?php

namespace App\Component\Factory;

use App\Entity\Inflow;

class InflowFactory
{
    public function create(
        \DateTimeInterface $transactionDate,
        string $revenueSource,
        float $amount,
        string $currency,
        string $paymentMethod,
        string $notes
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