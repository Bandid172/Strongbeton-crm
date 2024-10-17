<?php

namespace App\Component\Factory;

use App\Entity\Outflow;

class OutflowFactory
{
    public function create(
        \DateTimeInterface $transactionDate,
        string $expenseCategory,
        float $amount,
        string $currency,
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