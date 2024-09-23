<?php

namespace App\Controller;

use App\componenet\factory\OrderFactory;
use App\componenet\manager\OrderManager;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderCreateAction extends AbstractController
{
    public function __construct(
        private OrderManager $orderManager,
        private OrderFactory $orderFactory,
    )
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(Order $data): void
    {
        $order = $this->orderFactory->create(
            $data->getCustomer(),
            $data->getOrderDate(),
            $data->getStatus(),
            $data->getPaymentMethod(),
            $data->getShippingAddress(),
            $data->getOrderItem(),
            $data->getTotalQuantity(),
            $data->getDiscount(),
            $data->getShippingCost(),
            $data->getPaymentMethod(),
            $data->getPaidAmount(),
            $data->getDeliveryStatus(),
            $data->getSalesRepresentative(),
            $data->getNotes(),
        );

        foreach ($data->getVehicles() as $vehicle) {
            $order->addVehicle($vehicle);
        }

        $this->orderManager->save($order, true);
    }
}