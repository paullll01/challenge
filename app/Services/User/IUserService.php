<?php

namespace App\Services\User;

use App\Models\User;

interface IUserService
{
    public function getUserByEmail(string $email): ?User;

    public function checkPasswordMatches(User $user, string $password): void;

    public function getUserWithMostTickets(): string;
}
