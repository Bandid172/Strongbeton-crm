<?php

namespace App\Controller;

use App\componenet\builder\CustomerBuilder;
use App\componenet\manager\CustomerManager;
use App\Entity\Customer;
use Exception;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CustomerCreateAction extends AbstractController
{
    public function __construct(
        private readonly CustomerManager $customerManager,
        private readonly CustomerBuilder $builder,
    )
    {
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function __invoke(Customer $data): void
    {
        $customer = $this->builder
            ->setFirstName($data->getFirstName())
            ->setLastName($data->getLastName())
            ->setPhoneNumber($data->getPhoneNumber())
            ->setEmail($data->getEmail() ?? null)
            ->setNotes($data->getNotes() ?? null)
            ->setCreatedAt()
            ->setUpdatedAt();

        foreach ($data->getOrganization() as $organization) {
            $customer->addOrganization($organization);
        }

        $customer = $this->builder->build();

        $this->customerManager->save($customer, true);

        exit();
    }
}