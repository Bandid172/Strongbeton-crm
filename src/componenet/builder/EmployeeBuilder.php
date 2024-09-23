<?php

namespace App\componenet\builder;

use App\Entity\Employee;
use App\Entity\User;
use App\Entity\MediaObject;
use App\Entity\Order;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;

class EmployeeBuilder
{
    private Employee $employee;

    public function __construct()
    {
        $this->employee = new Employee();
    }

    public function setName(string $name): self
    {
        $this->employee->setName($name);
        return $this;
    }

    public function setLastName(string $lastName): self
    {
        $this->employee->setLastName($lastName);
        return $this;
    }

    public function setMiddleName(?string $middleName): self
    {
        $this->employee->setMiddleName($middleName);
        return $this;
    }

    public function setDateOfBirth(\DateTimeImmutable $dateOfBirth): self
    {
        $this->employee->setDateOfBirth($dateOfBirth);
        return $this;
    }

    public function setGender(string $gender): self
    {
        $this->employee->setGender($gender);
        return $this;
    }

    public function setEmail(?string $email): self
    {
        $this->employee->setEmail($email);
        return $this;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->employee->setPhoneNumber($phoneNumber);
        return $this;
    }

    public function setAddress(string $address): self
    {
        $this->employee->setAddress($address);
        return $this;
    }

    public function setDepartment(string $department): self
    {
        $this->employee->setDepartment($department);
        return $this;
    }

    public function setPosition(string $position): self
    {
        $this->employee->setPosition($position);
        return $this;
    }

    public function setDateOfHire(\DateTimeInterface $dateOfHire): self
    {
        $this->employee->setDateOfHire($dateOfHire);
        return $this;
    }

    public function setDateOfTermination(?\DateTimeInterface $dateOfTermination): self
    {
        $this->employee->setDateOfTermination($dateOfTermination);
        return $this;
    }

    public function setState(string $state): self
    {
        $this->employee->setState($state);
        return $this;
    }

    public function setNotes(?string $notes): self
    {
        $this->employee->setNotes($notes);
        return $this;
    }

    public function setUser(?User $user): self
    {
        $this->employee->setUser($user);
        return $this;
    }

    public function setPicture(?MediaObject $picture): self
    {
        $this->employee->setPicture($picture);
        return $this;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->employee->setCreatedAt($createdAt);
        return $this;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->employee->setUpdatedAt($updatedAt);
        return $this;
    }

    /**
     * @throws Exception
     */
    public function setTimestamps(): self
    {
        $createdAt = new \DateTimeImmutable('now', new \DateTimeZone('Asia/Tashkent'));
        $updatedAt = new \DateTime('now', new \DateTimeZone('Asia/Tashkent'));

        $this->employee->setCreatedAt($createdAt);
        $this->employee->setUpdatedAt($updatedAt);

        return $this;
    }

    public function addOrder(Order $order): self
    {
        $this->employee->addOrder($order);
        return $this;
    }

    public function build(): Employee
    {
        return $this->employee;
    }
}
