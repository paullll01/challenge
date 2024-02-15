<?php

namespace App\DTO\Auth;

class GetUserTokenResponseDTO
{
    public function __construct(
        public string $token,
    ) {
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
