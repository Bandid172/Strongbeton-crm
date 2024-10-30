<?php

namespace App\Component\Factory;

use App\Entity\Currency;

class CurrencyFactory
{
    public function create(string $name): Currency
    {
        $currency = new Currency();
        $currency->setName($name);

        return $currency;
    }
}