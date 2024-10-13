<?php

namespace App\Component\Factory;

use App\Entity\Organization;

class OrganizationFactory
{
    public function create(
        string $name,
        string $phoneNumber,
        string $email,
        string $address,
        string $city,
        string $province,
        bool $active,
        ?string $industry,
        ?string $website,
        ?string $notes,
    ): Organization
    {
        $organization = new Organization();

        $organization
            ->setName($name)
            ->setPhoneNumber($phoneNumber)
            ->setEmail($email)
            ->setAddress($address)
            ->setCity($city)
            ->setProvince($province)
            ->setActive($active)
            ->setIndustry($industry)
            ->setWebsite($website)
            ->setNotes($notes)
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTime());

        return $organization;
    }
}