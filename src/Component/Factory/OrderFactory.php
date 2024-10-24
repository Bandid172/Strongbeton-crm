<?php

namespace App\Component\Factory;

use App\Entity\Customer;
use App\Entity\Employee;
use App\Entity\Order;
use App\Entity\Product;
use App\Services\OrderNumberGenerator;
use App\Services\PaymentMethodStrategy;
use App\Services\PaymentStatusStrategy;
use App\Services\SalesOrderBalanceDueCalculator;
use App\Services\SalesOrderCalculateSubTotal;
use App\Services\SalesOrderCalculateTotalAmount;
use App\Services\SalesOrderStatusStrategy;
use Exception;

class OrderFactory
{
    /**
     * @throws Exception
     */
    public function create(
        Customer $customer,
        \DateTimeInterface $orderDate,
        string $paymentStatus,
        string $shippingAddress,
        Product $orderItem,
        int $totalQuantity,
        float $discount,
        float $shippingCost,
        string $paymentMethod,
        float $paidAmount,
        Employee $salesRepresentative,
        string $notes,
        iterable $vehicles,
    ): Order
    {
        $order = new Order();

        $paymentState = PaymentStatusStrategy::getPaymentStatus($paymentStatus);

        $order
            ->setCustomer($customer)
            ->setOrderNumber(OrderNumberGenerator::generateOrderNumber())
            ->setOrderDate($orderDate)
            ->setStatus(SalesOrderStatusStrategy::getSalesOrderStatus('Pending'))
            ->setPaymentStatus($paymentState)
            ->setShippingAddress($shippingAddress)
            ->setOrderItem($orderItem)
            ->setTotalQuantity($totalQuantity)
            ->setDiscount($discount)
            ->setShippingCost($shippingCost)
            ->setShippingRequired(true)
            ->setPaymentMethod(PaymentMethodStrategy::getPaymentMethod($paymentMethod))
            ->setSubTotal()
            ->setTotalAmount()
            ->setBalanceDue(123)
            ->setPaidAmount($paidAmount)
            ->setDeliveryStatus(SalesOrderStatusStrategy::getDeliveryStatus('Awaiting Shipment'))
            ->setSalesRepresentative($salesRepresentative)
            ->setNotes($notes);

        foreach ($vehicles as $vehicle) {
            $order->addVehicle($vehicle);
        }

        return $order;
    }
}