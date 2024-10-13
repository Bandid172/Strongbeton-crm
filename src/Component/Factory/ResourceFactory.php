<?php

namespace App\Component\Factory;

use App\Entity\Resource;
use Exception;

class ResourceFactory
{
    /**
     * @throws Exception
     */
    public function create(string $name, float $quantity, string $resource_uom): Resource
    {
        $resource = new Resource();

        $resource->setName($name);
        $resource->setQuantity($quantity);
        $resource->setResourceUom($resource_uom);
        $resource->setCreatedAt(new \DateTimeImmutable('now', new \DateTimeZone('Asia/Tashkent')));
        $resource->setUpdatedAt(new \DateTime('now', new \DateTimeZone('Asia/Tashkent')));

        return $resource;
    }
}