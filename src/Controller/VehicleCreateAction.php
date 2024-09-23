<?php

namespace App\Controller;

use App\componenet\factory\VehicleFactory;
use App\componenet\manager\VehicleManager;
use App\Entity\Vehicle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VehicleCreateAction extends AbstractController
{
    public function __construct(private VehicleManager $vehicleManager, private VehicleFactory $vehicleFactory)
    {

    }
    public function __invoke(Vehicle $data): void
    {
        $vehicle = $this->vehicleFactory->create(
            $data->getName(),
            $data->getPlateNumber(),
            $data->getStatus(),
            $data->getDriver()
        );

        $this->vehicleManager->save($vehicle, true);

        exit();
    }
}