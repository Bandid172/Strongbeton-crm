<?php

namespace App\Controller;

use App\Component\Factory\ResourceFactory;
use App\Component\Manager\ResourceManager;
use App\Entity\Resource;
use Exception;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ResourceCreateAction extends AbstractController
{
    public function __construct(
        private readonly ResourceFactory $resourceFactory,
        private readonly ResourceManager $resourceManager
    )
    {
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function __invoke(Resource $data): void
    {
        $resource = $this->resourceFactory->create($data->getName(), $data->getQuantity(), $data->getResourceUom());

        $this->resourceManager->save($resource, true);

        exit;
    }
}