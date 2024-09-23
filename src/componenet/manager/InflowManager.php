<?php

namespace App\componenet\manager;

use App\Entity\Inflow;
use Doctrine\ORM\EntityManagerInterface;

class InflowManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function save(Inflow $inflow, bool $isNeedFlush = false): void
    {
        $this->entityManager->persist($inflow);

        if ($isNeedFlush) {
            $this->entityManager->flush();
        }
    }
}