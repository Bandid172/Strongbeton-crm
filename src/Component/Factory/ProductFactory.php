<?php

namespace App\Component\Factory;

use App\Entity\Currency;
use App\Entity\Product;
use App\Entity\Uom;
use App\Repository\ResourceRepository;
use App\Services\ProductCalculateMaximumStock;
use Exception;

class ProductFactory
{
    private ResourceRepository $resourceRepository;

    public function __construct(ResourceRepository $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
    }
    /**
     * @throws Exception
     */
    public function create(
        string $name,
        string $description,
        Uom $uom,
        bool $enabled,
        float $pricePerUnit,
        float $costPerUnit,
        float $requiredSand,
        float $requiredCement,
        float $requiredWater,
        float $requiredStone,
        Currency $currency,
    ): Product
    {
        $product = new Product();

        $maxProductStock = ProductCalculateMaximumStock::calculate($this->resourceRepository,$requiredSand, $requiredCement, $requiredWater, $requiredStone);

        $product
            ->setName($name)
            ->setDescription($description)
            ->setUom($uom)
            ->setEnabled($enabled)
            ->setPricePerUnit($pricePerUnit)
            ->setCostPerUnit($costPerUnit)
            ->setStockQuantity($maxProductStock)
            ->setRequiredSandAmount($requiredSand)
            ->setRequiredCementAmount($requiredCement)
            ->setRequiredWaterAmount($requiredWater)
            ->setRequiredStoneAmount($requiredStone)
            ->setCurrency($currency);

        ProductCalculateMaximumStock::updateInventoryStatus($product);

        return $product;
    }
}