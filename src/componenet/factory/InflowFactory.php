<?php

namespace App\componenet\factory;

use App\Entity\Inflow;
use Exception;

class InflowFactory
{
    /**
     * @throws Exception
     */
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
            ->setNotes($notes)
            ->setCreatedAt(new \DateTimeImmutable('now', new \DateTimeZone('Asia/Tashkent')))
            ->setUpdatedAt(new \DateTime('now', new \DateTimeZone('Asia/Tashkent')));

        return $inflow;
    }
}