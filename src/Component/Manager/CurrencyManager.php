<?php

namespace App\Component\Manager;

use App\Entity\Currency;
use Doctrine\ORM\EntityManagerInterface;

class CurrencyManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function save(Currency $currency, bool $isNeedFlush = false): void
    {
        $this->entityManager->persist($currency);

        if ($isNeedFlush) {
            $this->entityManager->flush();
        }
    }
}