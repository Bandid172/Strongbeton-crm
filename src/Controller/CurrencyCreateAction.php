<?php

namespace App\Controller;

use App\Component\Factory\CurrencyFactory;
use App\Component\Manager\CurrencyManager;
use App\Entity\Currency;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CurrencyCreateAction extends AbstractController
{
    public function __construct(
        private readonly CurrencyFactory $currencyFactory,
        private readonly CurrencyManager $currencyManager,
    )
    {
    }

    #[NoReturn] public function __invoke(Currency $data): void
    {
        $currency = $this->currencyFactory->create($data->getName());

        $this->currencyManager->save($currency, true);

        exit;
    }
}