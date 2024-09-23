<?php

namespace App\componenet\manager;

use App\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;

class EmployeeManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function save(Employee $employee, bool $isNeedFlush = false)
    {
        $this->entityManager->persist($employee);

        if ($isNeedFlush) {
            $this->entityManager->flush();
        }
    }
}