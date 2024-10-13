<?php

namespace App\Controller;

use App\Component\Factory\SalaryFactory;
use App\Component\Manager\SalaryManager;
use App\Entity\SalaryReport;
use App\Repository\SalaryReportRepository;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class SalaryCreateAction extends AbstractController
{
    public function __construct(private readonly SalaryFactory $salaryFactory, private readonly SalaryManager $salaryManager)
    {
    }

    #[NoReturn] public function __invoke(SalaryReport $data): void
    {
        $salaryReportData = $this->salaryFactory->create(
            $data->getBaseSalary(),
            $data->getPayPeriod(),
            $data->getPayDate() ?? null,
            $data->getCurrency(),
            $data->getBonuses(),
            $data->getDeductions(),
            $data->getTaxInformation(),
            $data->getSalaryType(),
            $data->getPaymentMethod(),
            $data->getPayrollStatus(),
            $data->getNotes(),
            $data->getPaidSalaryAmount(),
            $data->getEmployee()
        );

        $this->salaryManager->save($salaryReportData, true);

        exit();
    }
    #[NoReturn] #[Route('/salary-tax-calculator', name: 'salaryTaxCalculator')]
    public function calculateSalaryTax(SalaryReportRepository $salaryReportRepository): void
    {
        $salaryReport = $salaryReportRepository->findAll();

        dd($salaryReport);
    }
}