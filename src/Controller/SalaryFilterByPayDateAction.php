<?php

namespace App\Controller;

use App\Repository\SalaryReportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SalaryFilterByPayDateAction extends AbstractController
{
    /**
     * @throws ExceptionInterface
     */
    #[Route('/salary-filter-by-date', name: 'salary_filter_by_date', methods: 'GET')]
    public function getFilteredSalaryReport(
        SalaryReportRepository $salaryReportRepository,
        Request $request,
        NormalizerInterface $normalizer
    ): JsonResponse
    {
        $payPeriod = $request->query->get('payPeriod');
        $year = $request->query->get('year');

        if (!$payPeriod || !$year) {
            throw new \InvalidArgumentException('Pay period and year are required.');
        }

        $salaryReport = $salaryReportRepository->findAllByPayPeriod($payPeriod, $year);

        if (empty($salaryReport)) {
            return new JsonResponse([
                'data' => [],
                'message' => 'No records found.'
            ]);
        }

        $data = $normalizer->normalize($salaryReport, 'json');

        return new JsonResponse([
            'filteredSalaryData' => $data
        ], 200);
    }
}