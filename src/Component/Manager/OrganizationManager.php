<?php

namespace App\Component\Manager;

use App\Entity\Organization;
use Doctrine\ORM\EntityManagerInterface;

class OrganizationManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function save(Organization $organization, bool $isNeedFlush = false): void
    {
        $this->entityManager->persist($organization);

        if ($isNeedFlush) {
            $this->entityManager->flush();
        }
    }
}