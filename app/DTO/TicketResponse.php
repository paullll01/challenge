<?php

namespace App\DTO;

class TicketResponse
{
    public function __construct(
        public int $id,
        public string $subject,
        public string $content,
        public string $user_name,
        public string $user_email,
        public bool $status,
    ) {
    }

    public function getId(): int
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
