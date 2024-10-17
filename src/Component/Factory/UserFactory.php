<?php

namespace App\Component\Factory;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class UserFactory
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function create(string $username, string $password, array $roles): User
    {
        $user = new User();

        $user
            ->setUsername($username)
            ->setPassword($this->passwordHasher->hashPassword($user, $password))
            ->setRoles($roles);

        return $user;
    }
}