<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket;
use App\Values\Ticket\CreateTicketRequest;

interface ITicketRepository
{
    public function create(CreateTicketRequest $createTicketRequest) : Ticket;

    // public function update(Ticket $ticket): Ticket;
    // public function findById(int $id): Ticket;
    // public function findByEmail(): array;
}