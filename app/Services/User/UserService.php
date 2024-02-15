<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\IUserRepository;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService
{
    private IUserRepository $userRepository;
    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->userRepository->findByEmail($email);
    }


    public function checkPasswordMatches(User $user, string $password): void
    {
        if (!Hash::check($password, $user->password)) {
            throw new \ErrorException("Password does not match");
        }
    }

    public function getUserWithMostTickets(): string
    {
        return $this->userRepository->getUserWithMostTickets();
    }
}
