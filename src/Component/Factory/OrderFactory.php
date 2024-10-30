<?php

namespace App\Component\Factory;

use App\Entity\Currency;
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
        string $paymentStatus,
        string $shippingAddress,
        Product $orderItem,
        int $totalQuantity,
        float $discount,
        bool $isShippingRequired,
        float $shippingCost,
        string $paymentMethod,
        float $paidAmount,
        Employee $salesRepresentative,
        string $notes,
        iterable $vehicles,
        Currency $currency
    ): Order
    {
        $order = new Order();

        $order
            ->setCustomer($customer)
            ->setOrderNumber()
            ->setOrderDate($orderDate)
            ->setStatus('Pending')
            ->setPaymentStatus($paymentStatus)
            ->setShippingAddress($shippingAddress)
            ->setOrderItem($orderItem)
            ->setTotalQuantity($totalQuantity)
            ->setDiscount($discount)
            ->setShippingRequired($isShippingRequired)
            ->setShippingCost($shippingCost)
            ->setPaymentMethod($paymentMethod)
            ->setSubTotal()
            ->setPaidAmount($paidAmount)
            ->setDeliveryStatus('Awaiting Shipment')
            ->setSalesRepresentative($salesRepresentative)
            ->setNotes($notes)
            ->setCurrency($currency);

        foreach ($vehicles as $vehicle) {
            $order->addVehicle($vehicle);
        }

        return $order;
    }
}