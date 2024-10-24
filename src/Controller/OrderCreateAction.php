<?php

namespace App\Controller;

use App\Component\Factory\OrderFactory;
use App\Component\Factory\PaymentFactory;
use App\Component\Manager\OrderManager;
use App\Component\Manager\PaymentManager;
use App\Entity\Order;
use App\Repository\OrderRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class OrderCreateAction extends AbstractController
{
    public function __construct(
        private readonly OrderManager $orderManager,
        private readonly OrderFactory $orderFactory,
        private readonly PaymentFactory $paymentFactory,
        private readonly PaymentManager $paymentManager,
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
            $data->getPaymentStatus(),
            $data->getShippingAddress(),
            $data->getOrderItem(),
            $data->getTotalQuantity(),
            $data->getDiscount(),
            $data->getShippingCost(),
            $data->getPaymentMethod(),
            $data->getPaidAmount(),
            $data->getSalesRepresentative(),
            $data->getNotes(),
            $data->getVehicle()
        );

        $payment = $this->paymentFactory->create($order);

        $order->setPayment($payment);

        $this->paymentManager->save($payment, true);
        $this->orderManager->save($order, true);
    }

    #[Route('/dist', name: 'app_display')]
    public function display(OrderRepository $orderRepository)
    {
        $orders = $orderRepository->findAll();

        dd($orders);
    }
}
