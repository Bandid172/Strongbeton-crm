<?php

namespace App\Component\Manager;

use App\Entity\Uom;
use Doctrine\ORM\EntityManagerInterface;

class UomManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function save(Uom $uom, bool $isNeedFlush = false): void
    {
        $this->entityManager->persist($uom);

        if ($isNeedFlush) {
            $this->entityManager->flush();
        }
    }
}