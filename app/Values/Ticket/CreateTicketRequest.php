<?php

namespace App\Values\Ticket;

use App\Models\Ticket;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\{Email, Required, Max};


class CreateTicketRequest extends Data
{
    private $ticket;

    public function __construct(
        #[Required]
        public string $subject,
        #[Required]
        public string $content,
        #[Required]
        public string $user_name,
        #[Required, Email]
        public string $user_email,
        #[Required]
        public bool $status = false
    ){
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
