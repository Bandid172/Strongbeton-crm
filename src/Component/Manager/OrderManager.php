<?php

namespace App\Component\Manager;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;

class OrderManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function save(Order $order, bool $isNeedFlush = false): void
    {
        $this->entityManager->persist($order);

        if ($isNeedFlush) {
            $this->entityManager->flush();
        }
    }
}