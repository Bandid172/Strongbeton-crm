<?php

namespace App\Controller;

use App\Component\Factory\UserFactory;
use App\Component\Manager\UserManager;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserCreateAction extends AbstractController
{
    public function __construct(private UserFactory $userFactory, private UserManager $userManager)
    {

    }
    public function __invoke(User $data): void
    {
        $user = $this->userFactory->create($data->getUsername(), $data->getPassword(), $data->getRoles());
        $this->userManager->save($user, true);

        exit;
    }
}