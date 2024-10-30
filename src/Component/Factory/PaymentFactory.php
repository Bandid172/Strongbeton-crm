<?php

namespace App\Component\Factory;

use App\Entity\Order;
use App\Entity\Payment;

class PaymentFactory
{
    public function create(
        Order $order
    ): Payment
    {
        $payment = new Payment();

        $payment
            ->setOrderId($order)
            ->setPaymentDate(new \DateTime())
            ->setAmountPaid($order->getPaidAmount())
            ->setPaymentMethod($order->getPaymentMethod())
            ->setPaymentStatus($order->getPaymentStatus())
            ->setBalanceDue($order->getBalanceDue())
            ->setCustomer($order->getCustomer())
            ->setCurrency($order->getCurrency());

        return $payment;
    }
}
