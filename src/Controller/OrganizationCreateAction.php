<?php

namespace App\Controller;

use App\componenet\builder\OrganizationBuilder;
use App\componenet\manager\OrganizationManager;
use App\Entity\Organization;
use Exception;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrganizationCreateAction extends AbstractController
{
    public function __construct(
        private readonly OrganizationManager $organizationManager,
        private readonly OrganizationBuilder $organizationBuilder)
    {

    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function __invoke(Organization $data): void
    {
        $organization = $this->organizationBuilder
            ->setName($data->getName())
            ->setPhoneNumber($data->getPhoneNumber())
            ->setEmail($data->getEmail())
            ->setAddress($data->getAddress())
            ->setCity($data->getCity())
            ->setProvince($data->getProvince())
            ->setActive($data->isActive())
            ->setIndustry($data->getIndustry())
            ->setWebsite($data->getWebsite())
            ->setNotes($data->getNotes())
            ->setTimestamps()
            ->build();

        $this->organizationManager->save($organization, true);

        exit();
    }
}