<?php

namespace App\Component\Factory;

use App\Entity\Employee;
use App\Entity\MediaObject;
use App\Entity\User;

class EmployeeFactory
{
    public function create(
        string $name,
        string $lastName,
        ?string $middleName,
        \DateTimeImmutable $DateOfBirth,
        string $gender,
        ?string $email,
        string $phoneNumber,
        string $address,
        string $department,
        string $position,
        \DateTimeInterface $dateOfHire,
        string $state,
        ?string $notes,
        ?User $user,
        ?MediaObject $picture
    ): Employee
    {
        $employee = new Employee();

        $employee
            ->setName($name)
            ->setLastName($lastName)
            ->setMiddleName($middleName)
            ->setDateOfBirth($DateOfBirth)
            ->setGender($gender)
            ->setEmail($email)
            ->setPhoneNumber($phoneNumber)
            ->setAddress($address)
            ->setDepartment($department)
            ->setPosition($position)
            ->setDateOfHire($dateOfHire)
            ->setState($state)
            ->setNotes($notes)
            ->setUser($user)
            ->setPicture($picture);

        return $employee;
    }
}