<?php

namespace App\Values\Auth;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Email;

class GetUserTokenRequest extends Data
{
    public function __construct(
        #[Email]
        public readonly string $email,
        public readonly string $device_name,
        public readonly string $password,
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDeviceName(): string
    {
        return $this->device_name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

}
