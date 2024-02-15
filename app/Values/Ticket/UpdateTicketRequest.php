<?php

namespace App\Values\Ticket;

use App\Models\Ticket;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\{Email, Required, Max};


class UpdateTicketRequest extends Data
{

    public function __construct(
        #[Required]
        public readonly int $id,
        #[Required]
        public readonly string $subject,
        #[Required]
        public readonly string $content,
        #[Required]
        public readonly string $user_name,
        #[Required, Email]
        public readonly string $user_email,
        #[Required]
        public readonly bool $status = false
    ){
    }

    public function getTicketId(): int
    {
        return $this->id;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getUserName(): string
    {
        return $this->user_name;
    }

    public function getUserEmail(): string
    {
        return $this->user_email;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }
}
