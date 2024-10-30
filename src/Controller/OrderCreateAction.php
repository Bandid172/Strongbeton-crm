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
    public function __invoke(Order $data): Order
    {
        $order = $this->orderFactory->create(
            $data->getCustomer(),
            $data->getOrderDate(),
            $data->getPaymentStatus(),
            $data->getShippingAddress(),
            $data->getOrderItem(),
            $data->getTotalQuantity(),
            $data->getDiscount(),
            $data->isShippingRequired(),
            $data->getShippingCost(),
            $data->getPaymentMethod(),
            $data->getPaidAmount(),
            $data->getSalesRepresentative(),
            $data->getNotes(),
            $data->getVehicle(),
            $data->getCurrency()
        );

        $payment = $this->paymentFactory->create($order);

        $order->setPayment($payment);

        $this->paymentManager->save($payment, true);
        $this->orderManager->save($order, true);

        return $order;
    }

    #[Route('/dist', name: 'app_display')]
    public function display(OrderRepository $orderRepository)
    {
        $orders = $orderRepository->findAll();

        dd($orders);
    }
}
