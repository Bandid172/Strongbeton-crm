<?php

namespace App\Controller;

use App\Component\Factory\OutflowFactory;
use App\Component\Manager\OutflowManager;
use App\Entity\Outflow;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OutflowCreateAction extends AbstractController
{
    public function __construct(
        private readonly OutflowManager $outflowManager,
        private readonly OutflowFactory $outflowFactory,
    )
    {
    }
    #[NoReturn] public function __invoke(Outflow $data): void
    {
        $outflow = $this->outflowFactory->create(
            $data->getTransactionDate(),
            $data->getExpenseCategory(),
            $data->getAmount(),
            $data->getCurrency(),
            $data->getPaymentMethod(),
            $data->getExpenseDescription()
        );

        $this->outflowManager->save($outflow, true);

        exit();
    }
}