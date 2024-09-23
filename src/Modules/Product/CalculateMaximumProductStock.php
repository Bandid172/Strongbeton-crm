<?php

namespace App\Modules\Product;

use App\Entity\Product;
use App\Repository\ResourceRepository;
use Exception;

class CalculateMaximumProductStock
{
    /**
     * @throws Exception
     */
    public static function calculate(ResourceRepository $resourceRepository, $requiredSand, $requiredCement, $requiredWater, $requiredStone): int
    {
        $sand = $resourceRepository->findOneBy(['name' => 'sand']);
        $cement = $resourceRepository->findOneBy(['name' => 'cement']);
        $water = $resourceRepository->findOneBy(['name' => 'water']);
        $stone = $resourceRepository->findOneBy(['name' => 'stone']);

        // Ensure that each resource is found before accessing its quantity
        if (!$sand || !$cement || !$water || !$stone) {
            throw new Exception('One or more resources are not available.');
        }

        $productCapacityBySand = floor($sand->getQuantity() / $requiredSand);
        $productCapacityByCement = floor($cement->getQuantity() / $requiredCement);
        $productCapacityByWater = floor($water->getQuantity() / $requiredWater);
        $productCapacityByStone = floor($stone->getQuantity() / $requiredStone);

        return (int) min($productCapacityBySand, $productCapacityByCement, $productCapacityByWater, $productCapacityByStone);
    }

    public static function updateInventoryStatus(Product $product): void
    {
        $inventoryStatus = $product->getStockQuantity() > 0 ? Product::IN_STOCK : Product::OUT_OF_STOCK;
        $product->setInventoryStatus($inventoryStatus);
    }
}