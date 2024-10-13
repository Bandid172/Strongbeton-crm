<?php

namespace App\Component\Manager;

use App\Entity\Vehicle;
use Doctrine\ORM\EntityManagerInterface;

class VehicleManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function save(Vehicle $vehicle, bool $isNeedFlush = false): void
    {
        $this->entityManager->persist($vehicle);

        if ($isNeedFlush) {
            $this->entityManager->flush();
        }
    }
}