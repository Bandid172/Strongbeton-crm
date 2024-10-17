<?php

namespace App\Component\Factory;

use App\Entity\Employee;
use App\Entity\Vehicle;

class VehicleFactory
{
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
            ->setDriver($driver);

        return $vehicle;
    }
}