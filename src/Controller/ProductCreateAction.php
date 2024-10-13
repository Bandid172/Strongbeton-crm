<?php

namespace App\Controller;

use App\Component\Factory\ProductFactory;
use App\Component\Manager\ProductManager;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class ProductCreateAction extends AbstractController
{
    public function __construct(private ProductFactory $productFactory, private ProductManager $productManager)
    {

    }
    public function __invoke(Product $data)
    {
        $product = $this->productFactory->create(
            $data->getName(),
            $data->getDescription(),
            $data->getUom(),
            $data->isEnabled(),
            $data->getPricePerUnit(),
            $data->getCostPerUnit(),
            $data->getRequiredSandAmount(),
            $data->getRequiredCementAmount(),
            $data->getRequiredWaterAmount(),
            $data->getRequiredStoneAmount()
        );

        $this->productManager->save($product, true);

        exit();
    }
    #[Route('/products', name: 'product_show')]
    public function showProducts(ProductRepository $productRepository)
    {
        $product = $productRepository->findAll();

        dd($product);
    }
}