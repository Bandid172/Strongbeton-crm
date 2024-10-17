<?php

namespace App\Controller;

use App\Component\Factory\VehicleFactory;
use App\Component\Manager\VehicleManager;
use App\Entity\Vehicle;
use Exception;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VehicleCreateAction extends AbstractController
{
    public function __construct(
        private readonly VehicleManager $vehicleManager,
        private readonly VehicleFactory $vehicleFactory
    )
    {

    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function __invoke(Vehicle $data): void
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