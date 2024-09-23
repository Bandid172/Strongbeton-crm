<?php

namespace App\Controller;

use App\componenet\builder\EmployeeBuilder;
use App\componenet\manager\EmployeeManager;
use App\Entity\Employee;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmployeeCreateAction extends AbstractController
{
    public function __construct(
        private readonly EmployeeManager $employeeManager,
        private readonly EmployeeBuilder $employeeBuilder
    )
    {
    }

    /**
     * @throws \Exception
     */
    #[NoReturn] public function __invoke(Employee $data): void
    {
        $employee = $this->employeeBuilder
            ->setName($data->getName())
            ->setLastName($data->getLastName())
            ->setMiddleName($data->getMiddleName())
            ->setDateOfBirth($data->getDateOfBirth())
            ->setGender($data->getGender())
            ->setEmail($data->getEmail())
            ->setPhoneNumber($data->getPhoneNumber())
            ->setAddress($data->getAddress())
            ->setDepartment($data->getDepartment())
            ->setPosition($data->getPosition())
            ->setDateOfHire($data->getDateOfHire())
            ->setDateOfTermination($data->getDateOfTermination())
            ->setState($data->getState())
            ->setNotes($data->getNotes())
            ->setUser($data->getUser())
            ->setPicture($data->getPicture())
            ->setTimestamps()
            ->build();

        $this->employeeManager->save($employee, true);

        exit();
    }
}