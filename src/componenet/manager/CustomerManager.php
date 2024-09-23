<?php

namespace App\componenet\manager;

use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;

class CustomerManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function save(Customer $customer, bool $isNeedFlush = false): void
    {
        $this->entityManager->persist($customer);

        if ($isNeedFlush) {
            $this->entityManager->flush();
        }
    }
}