<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket;
use App\Values\Ticket\CreateTicketRequest;
use App\Values\Ticket\UpdateTicketRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ITicketRepository
{
    public function create(CreateTicketRequest $createTicketRequest) : Ticket;

    public function update(UpdateTicketRequest $updateTicketRequest): Ticket;
    public function findById(int $id): Ticket;
    public function findOpenTickets(): LengthAwarePaginator;
    public function findClosedTickets(): LengthAwarePaginator;
    public function findUserTickets($email): LengthAwarePaginator;
    public function totalTickets(): int;
    public function totalUnprocessed(): int;
    public function lastProcessingTime(): string;
}