<?php

namespace App\Component\Manager;

use App\Entity\Payment;
use Doctrine\ORM\EntityManagerInterface;

class PaymentManager
{
    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function save(Payment $payment, bool $isNeedFlush = false): void
    {
        $this->entityManager->persist($payment);

        if ($isNeedFlush) {
            $this->entityManager->flush();
        }
    }
}