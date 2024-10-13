<?php

namespace App\Controller;

use App\Component\Manager\EmployeeManager;
use App\Component\Factory\EmployeeFactory;
use App\Entity\Employee;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmployeeCreateAction extends AbstractController
{
    public function __construct(
        private readonly EmployeeManager $employeeManager,
        private readonly EmployeeFactory $employeeFactory,
    )
    {
    }

    #[NoReturn] public function __invoke(Employee $data): void
    {
        $employee = $this->employeeFactory->create(
            $data->getName(),
            $data->getLastName(),
            $data->getMiddleName(),
            $data->getDateOfBirth(),
            $data->getGender(),
            $data->getEmail(),
            $data->getPhoneNumber(),
            $data->getAddress(),
            $data->getDepartment(),
            $data->getPosition(),
            $data->getDateOfHire(),
            $data->getState(),
            $data->getNotes(),
            $data->getUser(),
            $data->getPicture()
        );

        $this->employeeManager->save($employee, true);

        exit();
    }
}