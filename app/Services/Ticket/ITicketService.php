<?php 

namespace App\Services\Ticket;

use App\Models\Ticket;
use App\Values\Ticket\CreateTicketRequest;


interface ITicketService
{
    public function createTicket(CreateTicketRequest $createTicketRequest): Ticket;
    // public function updateTicket(Ticket $ticket): Ticket;
    // public function getTicket(int $id): Ticket;
    // public function getTickets(): array;
}