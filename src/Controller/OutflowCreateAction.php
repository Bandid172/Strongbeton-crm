<?php

namespace App\Controller;

use App\componenet\factory\OutflowFactory;
use App\componenet\manager\OutflowManager;
use App\Entity\Outflow;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OutflowCreateAction extends AbstractController
{
    public function __construct(
        private OutflowManager $outflowManager,
        private OutflowFactory $outflowFactory,
    )
    {
    }
    public function __invoke(Outflow $data): void
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