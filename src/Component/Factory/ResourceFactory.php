<?php

namespace App\Component\Factory;

use App\Entity\Resource;

class ResourceFactory
{
    public function create(string $name, float $quantity, string $resource_uom): Resource
    {
        $resource = new Resource();

        $resource
            ->setName($name)
            ->setQuantity($quantity)
            ->setResourceUom($resource_uom);

        return $resource;
    }
}