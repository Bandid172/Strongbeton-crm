<?php

namespace App\Controller;

use App\Component\Factory\UserFactory;
use App\Component\Manager\UserManager;
use App\Entity\User;
use Exception;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserCreateAction extends AbstractController
{
    public function __construct(
        private readonly UserFactory $userFactory,
        private readonly UserManager $userManager
    )
    {

    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function __invoke(User $data): void
    {
        $user = $this->userFactory->create($data->getUsername(), $data->getPassword(), $data->getRoles());
        $this->userManager->save($user, true);

        exit;
    }
}