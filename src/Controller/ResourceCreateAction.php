<?php

namespace App\Controller;

use App\Component\Factory\ResourceFactory;
use App\Component\Manager\ResourceManager;
use App\Entity\Resource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ResourceCreateAction extends AbstractController
{
    public function __construct(private ResourceFactory $resourceFactory, private ResourceManager $resourceManager)
    {
    }
    public function __invoke(Resource $data): void
    {
        $resource = $this->resourceFactory->create($data->getName(), $data->getQuantity(), $data->getResourceUom());

        $this->resourceManager->save($resource, true);

        exit;
    }
}