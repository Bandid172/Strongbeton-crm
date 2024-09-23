<?php

namespace App\componenet\manager;

use App\Entity\Resource;
use Doctrine\ORM\EntityManagerInterface;

class ResourceManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function save(Resource $resource, bool $isNeedFlush = false)
    {
        $this->entityManager->persist($resource);

        if ($isNeedFlush) {
            $this->entityManager->flush();
        }
    }
}