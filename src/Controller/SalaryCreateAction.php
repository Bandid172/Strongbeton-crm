<?php

namespace App\Controller;

use App\Component\Factory\SalaryFactory;
use App\Component\Manager\SalaryManager;
use App\Entity\SalaryReport;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class SalaryCreateAction extends AbstractController
{
    public function __construct(
        private readonly SalaryFactory $salaryFactory,
        private readonly SalaryManager $salaryManager
    )
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(SalaryReport $data): JsonResponse
    {
        $salaryReportData = $this->salaryFactory->create(
            $data->getGrossSalary(),
            $data->getPayPeriod(),
            $data->getCurrency(),
            $data->getBonuses(),
            $data->getDeductions(),
            $data->getTaxInformation(),
            $data->getSalaryType(),
            $data->getPaymentMethod(),
            $data->getNotes(),
            $data->getPaidSalaryAmount(),
            $data->getEmployee()
        );

        $this->salaryManager->save($salaryReportData, true);

        return new JsonResponse([
            'status' => 'Success',
            'message' => 'Salary report created.'
        ], 201);
    }
}