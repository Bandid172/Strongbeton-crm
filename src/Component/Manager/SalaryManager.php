<?php

namespace App\Component\Manager;

use App\Entity\SalaryReport;
use Doctrine\ORM\EntityManagerInterface;

class SalaryManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function save(SalaryReport $salaryReport, bool $isNeedFlush = false)
    {
        $this->entityManager->persist($salaryReport);

        if($isNeedFlush) {
            $this->entityManager->flush();
        }
    }
}