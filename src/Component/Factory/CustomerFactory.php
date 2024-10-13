<?php

namespace App\Component\Factory;

use App\Entity\Customer;

class CustomerFactory
{
    public function create(
        string $firstName,
        string $lastName,
        string $phoneNumber,
        ?string $email,
        ?string $notes,
        iterable $organizations
    ): Customer
    {
        $customer = new Customer();

        $customer
            ->setFirstName($firstName)
            ->setLastName($lastName)
            ->setPhoneNumber($phoneNumber)
            ->setEmail($email)
            ->setNotes($notes)
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTime());

        foreach ($organizations as $organization) {
            $customer->addOrganization($organization);
        }

        return $customer;
    }
}