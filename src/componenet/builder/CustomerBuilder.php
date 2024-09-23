<?php

namespace App\componenet\builder;

use App\Entity\Customer;
use App\Entity\Order;
use App\Entity\Organization;
use Exception;

class CustomerBuilder
{
    private Customer $customer;

    public function __construct()
    {
        $this->customer = new Customer();
    }

    public function setFirstName(string $firstName): self
    {
        $this->customer->setFirstName($firstName);
        return $this;
    }

    public function setLastName(string $lastName): self
    {
        $this->customer->setLastName($lastName);
        return $this;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->customer->setPhoneNumber($phoneNumber);
        return $this;
    }

    public function setEmail(?string $email): self
    {
        $this->customer->setEmail($email);
        return $this;
    }

    public function setNotes(?string $notes): self
    {
        $this->customer->setNotes($notes);
        return $this;
    }

    public function addOrganization(Organization $organization): self
    {
        $this->customer->addOrganization($organization);
        return $this;
    }

    public function addOrder(Order $order): self
    {
        $this->customer->addOrder($order);
        return $this;
    }

    /**
     * @throws Exception
     */
    public function setCreatedAt(): self
    {
        $this->customer->setCreatedAt(new \DateTimeImmutable('now', new \DateTimeZone('Asia/Tashkent')));
        return $this;
    }

    /**
     * @throws Exception
     */
    public function setUpdatedAt(): self
    {
        $this->customer->setUpdatedAt(new \DateTime('now', new \DateTimeZone('Asia/Tashkent')));
        return $this;
    }

    public function build(): Customer
    {
        return $this->customer;
    }
}