<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements IUserRepository
{
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function getUserWithMostTickets(): string
    {
        return User::withCount('tickets')->orderBy('tickets_count', 'desc')->first()->getName();
    }

}
