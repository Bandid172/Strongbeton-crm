<?php

namespace App\Component\Factory;

use App\Entity\Currency;
use App\Entity\Outflow;

class OutflowFactory
{
    public function create(
        \DateTimeInterface $transactionDate,
        string $expenseCategory,
        float $amount,
        Currency $currency,
        string $paymentMethod,
        string $expenseDescription,
    ): Outflow
    {
        $outflow = new Outflow();

        $outflow
            ->setTransactionDate($transactionDate)
            ->setExpenseCategory($expenseCategory)
            ->setAmount($amount)
            ->setCurrency($currency)
            ->setPaymentMethod($paymentMethod)
            ->setExpenseDescription($expenseDescription);

        return $outflow;
    }
}