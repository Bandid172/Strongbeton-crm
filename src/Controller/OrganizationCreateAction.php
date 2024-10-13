<?php

namespace App\Controller;

use App\Component\Factory\OrganizationFactory;
use App\Component\Manager\OrganizationManager;
use App\Entity\Organization;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrganizationCreateAction extends AbstractController
{
    public function __construct(
        private readonly OrganizationManager $organizationManager,
        private readonly OrganizationFactory $organizationFactory,
    )
    {
    }

    #[NoReturn] public function __invoke(Organization $data): void
    {
        $organization = $this->organizationFactory->create(
            $data->getName(),
            $data->getPhoneNumber(),
            $data->getEmail(),
            $data->getAddress(),
            $data->getCity(),
            $data->getProvince(),
            $data->isActive(),
            $data->getIndustry(),
            $data->getWebsite(),
            $data->getNotes()
        );

        $this->organizationManager->save($organization, true);

        exit();
    }
}