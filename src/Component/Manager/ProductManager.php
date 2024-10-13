<?php

namespace App\Component\Manager;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function save(Product $product, bool $isNeedFlush = false): void
    {
        $this->entityManager->persist($product);

        if($isNeedFlush) {
            $this->entityManager->flush();
        }
    }
}