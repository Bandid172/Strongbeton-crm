<?php

namespace App\componenet\factory;

use App\Entity\Customer;
use App\Entity\Employee;
use App\Entity\Order;
use App\Entity\Product;
use Exception;

class OrderFactory
{
    /**
     * @throws Exception
     */
    public function create(
        Customer $customer,
        \DateTimeInterface $orderDate,
        string $status,
        string $paymentStatus,
        string $shippingAddress,
        Product $orderItem,
        int $totalQuantity,
        float $discount,
        float $shippingCost,
        string $paymentMethod,
        float $paidAmount,
        string $deliveryStatus,
        Employee $salesRepresentative,
        string $notes,
    ): Order
    {
        $order = new Order();

        $order
            ->setCustomer($customer)
            ->setOrderNumber(123)
            ->setOrderDate($orderDate)
            ->setStatus($status)
            ->setPaymentStatus($paymentStatus)
            ->setShippingAddress($shippingAddress)
            ->setOrderItem($orderItem)
            ->setTotalQuantity($totalQuantity)
            ->setDiscount($discount)
            ->setShippingCost($shippingCost)
            ->setShippingRequired(true)
            ->setPaymentMethod($paymentMethod)
            ->setSubTotal(0)
            ->setTotalAmount(0)
            ->setBalanceDue(0)
            ->setPaidAmount($paidAmount)
            ->setDeliveryStatus($deliveryStatus)
            ->setSalesRepresentative($salesRepresentative)
            ->setNotes($notes)
            ->setCreatedAt(new \DateTimeImmutable('now', new \DateTimeZone('Asia/Tashkent')))
            ->setUpdatedAt(new \DateTime('now', new \DateTimeZone('Asia/Tashkent')));

        return $order;
    }
}