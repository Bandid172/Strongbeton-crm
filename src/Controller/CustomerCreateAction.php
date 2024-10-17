<?php

namespace App\Controller;

use App\Component\Factory\CustomerFactory;
use App\Component\Manager\CustomerManager;
use App\Entity\Customer;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CustomerCreateAction extends AbstractController
{
    public function __construct(
        private readonly CustomerManager $customerManager,
        private readonly CustomerFactory $customerFactory,
    )
    {
    }

    #[NoReturn] public function __invoke(Customer $data, ValidatorInterface $validator): void
    {
        $customer = $this->customerFactory->create(
            $data->getFirstName(),
            $data->getLastName(),
            $data->getPhoneNumber(),
            $data->getEmail(),
            $data->getNotes(),
            $data->getOrganization()
        );

        $this->customerManager->save($customer, true);

        exit();
    }
}