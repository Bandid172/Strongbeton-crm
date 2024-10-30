<?php

namespace App\Component\Factory;

use App\Entity\Currency;
use App\Entity\Resource;
use App\Entity\Uom;

class ResourceFactory
{
    public function create(
        string $name,
        float $quantity,
        Uom $resource_uom,
        Currency $currency,
    ): Resource
    {
        $resource = new Resource();

        $resource
            ->setName($name)
            ->setQuantity($quantity)
            ->setUom($resource_uom)
            ->setCurrency($currency);

        return $resource;
    }
}