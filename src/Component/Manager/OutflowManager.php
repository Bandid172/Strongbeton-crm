<?php

namespace App\Component\Manager;

use App\Entity\Outflow;
use Doctrine\ORM\EntityManagerInterface;

class OutflowManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {

    }
    public function save(Outflow $outflow, bool $isNeedFlush = false): void
    {
        $this->entityManager->persist($outflow);

        if ($isNeedFlush) {
            $this->entityManager->flush();
        }
    }
}