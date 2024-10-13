<?php

namespace App\Component\Factory;

use App\Entity\Customer;
use App\Entity\Employee;
use App\Entity\Order;
use App\Entity\Payment;
use App\Entity\Product;
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
        string $deliveryStatus,
        Employee $salesRepresentative,
        string $notes
    ): Order
    {
        $order = new Order();

        $subTotal = SalesOrderCalculateSubTotal::calculateTotal($orderItem, $totalQuantity);
        $totalAmount = SalesOrderCalculateTotalAmount::calculateTotalAmount($subTotal, $discount, $shippingCost);
        $balanceDue = SalesOrderBalanceDueCalculator::calculateBalanceDue($totalAmount, $paidAmount);
        $paymentState = PaymentStatusStrategy::getPaymentStatus($paymentStatus);

        $payment = new Payment();
        $payment
            ->setOrderId($order)
            ->setAmountPiad($paidAmount)
            ->setPaymentMethod($paymentMethod)
            ->setPaymentStatus($paymentState)
            ->setCurrency('UZS')
            ->setBalanceDue($balanceDue)
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTime())
            ->setCustomer($customer);

        $order
            ->setCustomer($customer)
            ->setOrderNumber(123)
            ->setOrderDate($orderDate)
            ->setStatus(SalesOrderStatusStrategy::getSalesOrderStatus('Pending'))
            ->setPaymentStatus($paymentState)
            ->setShippingAddress($shippingAddress)
            ->setOrderItem($orderItem)
            ->setTotalQuantity($totalQuantity)
            ->setDiscount($discount)
            ->setShippingCost($shippingCost)
            ->setShippingRequired(true)
            ->setPaymentMethod($paymentMethod)
            ->setSubTotal($subTotal)
            ->setTotalAmount($totalAmount)
            ->setBalanceDue($balanceDue)
            ->setPaidAmount($paidAmount)
            ->setDeliveryStatus($deliveryStatus)
            ->setSalesRepresentative($salesRepresentative)
            ->setNotes($notes)
            ->setCreatedAt(new \DateTimeImmutable('now', new \DateTimeZone('Asia/Tashkent')))
            ->setUpdatedAt(new \DateTime('now', new \DateTimeZone('Asia/Tashkent')))
            ->setPayment($payment);

        return $order;
    }
}