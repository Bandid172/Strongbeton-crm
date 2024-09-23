<?php

namespace App\Controller;

use App\componenet\factory\ResourceFactory;
use App\componenet\manager\ResourceManager;
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