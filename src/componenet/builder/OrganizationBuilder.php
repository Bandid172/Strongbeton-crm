<?php

namespace App\componenet\builder;

use App\Entity\Customer;
use App\Entity\Organization;
use Exception;

class OrganizationBuilder
{
    private Organization $organization;

    public function __construct()
    {
        $this->organization = new Organization();
    }

    public function setName(string $name): self
    {
        $this->organization->setName($name);
        return $this;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->organization->setPhoneNumber($phoneNumber);
        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->organization->setEmail($email);
        return $this;
    }

    public function setAddress(string $address): self
    {
        $this->organization->setAddress($address);
        return $this;
    }

    public function setCity(string $city): self
    {
        $this->organization->setCity($city);
        return $this;
    }

    public function setProvince(string $province): self
    {
        $this->organization->setProvince($province);
        return $this;
    }

    public function setActive(bool $isActive): self
    {
        $this->organization->setActive($isActive);
        return $this;
    }

    public function setIndustry(?string $industry): self
    {
        $this->organization->setIndustry($industry);
        return $this;
    }

    public function setWebsite(?string $website): self
    {
        $this->organization->setWebsite($website);
        return $this;
    }

    public function setNotes(?string $notes): self
    {
        $this->organization->setNotes($notes);
        return $this;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->organization->setCreatedAt($createdAt);
        return $this;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->organization->setUpdatedAt($updatedAt);
        return $this;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->organization->setCustomer($customer);
        return $this;
    }

    /**
     * @throws Exception
     */
    public function setTimestamps(): self
    {
        $createdAt = new \DateTimeImmutable('now', new \DateTimeZone('Asia/Tashkent'));
        $updatedAt = new \DateTime('now', new \DateTimeZone('Asia/Tashkent'));

        $this->organization->setCreatedAt($createdAt);
        $this->organization->setUpdatedAt($updatedAt);

        return $this;
    }

    public function build(): Organization
    {
        return $this->organization;
    }
}
