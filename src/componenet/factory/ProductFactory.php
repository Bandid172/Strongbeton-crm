<?php

namespace App\componenet\factory;

use App\Entity\Product;
use App\Modules\Product\CalculateMaximumProductStock;
use App\Repository\ResourceRepository;
use Exception;

class ProductFactory
{
    private $resourceRepository;

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
        string $uom,
        bool $enabled,
        float $pricePerUnit,
        float $costPerUnit,
        float $requiredSand,
        float $requiredCement,
        float $requiredWater,
        float $requiredStone
    ): Product
    {
        $product = new Product();

        $maxProductStock = CalculateMaximumProductStock::calculate($this->resourceRepository,$requiredSand, $requiredCement, $requiredWater, $requiredStone);

        $product
            ->setName($name)
            ->setDescription($description)
            ->setUom($uom)
            ->setEnabled($enabled)
            ->setPricePerUnit($pricePerUnit)
            ->setCostPerUnit($costPerUnit)
            ->setCreatedAt(new \DateTimeImmutable('now', new \DateTimeZone('Asia/Tashkent')))
            ->setUpdatedAt(new \DateTime('now', new \DateTimeZone('Asia/Tashkent')))
            ->setStockQuantity($maxProductStock)
            ->setRequiredSandAmount($requiredSand)
            ->setRequiredCementAmount($requiredCement)
            ->setRequiredWaterAmount($requiredWater)
            ->setRequiredStoneAmount($requiredStone);

        CalculateMaximumProductStock::updateInventoryStatus($product);

        return $product;
    }
}