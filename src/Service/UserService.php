<?php

namespace App\Service;

use App\DTO\UserDTO;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    private EntityManagerInterface $entityManager;

    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager)
    {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->entityManager = $entityManager;

    }

    public function createUser(UserDTO $userDTO): User
    {
        $user = new User();
        $user->setEmail($userDTO->email);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, $userDTO->plainPassword));

        return $user;
    }

    public function addUserToDatabase(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

}