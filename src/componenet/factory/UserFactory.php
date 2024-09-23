<?php

namespace App\componenet\factory;

use App\Entity\User;
use Exception;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    /**
     * @throws Exception
     */
    public function create(string $username, string $password, array $roles): User
    {
        date_default_timezone_set('Asia/Tashkent');

        $user = new User();
        $user->setUsername($username);
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));
        $user->setRoles($roles);
        $user->setCreatedAt(new \DateTimeImmutable('now', new \DateTimeZone('Asia/Tashkent')));
        $user->setUpdatedAt(new \DateTime('now', new \DateTimeZone('Asia/Tashkent')));

        return $user;
    }
}