<?php

namespace App\Component\Factory;

use App\Entity\Employee;
use App\Entity\Vehicle;
use Exception;

class VehicleFactory
{
    /**
     * @throws Exception
     */
    public function create(
        string $name,
        string $plateNumber,
        string $status,
        Employee $driver
    ): Vehicle
    {
        $vehicle = new Vehicle();

        $vehicle
            ->setName($name)
            ->setPlateNumber($plateNumber)
            ->setStatus($status)
            ->setDriver($driver)
            ->setCreatedAt(new \DateTimeImmutable('now', new \DateTimeZone('Asia/Tashkent')))
            ->setUpdatedAt(new \DateTime('now', new \DateTimeZone('Asia/Tashkent')));

        return $vehicle;
    }
}