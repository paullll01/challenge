<?php

namespace App\Repositories\User;

use App\Models\User;

interface IUserRepository
{
    public function findByEmail(string $email): ?User;

    public function getUserWithMostTickets(): string;

}
