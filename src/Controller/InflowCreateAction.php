<?php

namespace App\Controller;

use App\Component\Factory\InflowFactory;
use App\Component\Manager\InflowManager;
use App\Entity\Inflow;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InflowCreateAction extends AbstractController
{
    public function __construct(
        private readonly InflowManager $inflowManager,
        private readonly InflowFactory $inflowFactory,
    )
    {
    }
    #[NoReturn] public function __invoke(Inflow $data): void
    {
        $inflow = $this->inflowFactory->create(
            $data->getTransactionDate(),
            $data->getRevenueSource(),
            $data->getAmount(),
            $data->getCurrency(),
            $data->getPaymentMethod(),
            $data->getNotes()
        );

        $this->inflowManager->save($inflow, true);

        exit;
    }
}