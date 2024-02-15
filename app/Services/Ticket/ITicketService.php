<?php 

namespace App\Services\Ticket;

use App\Models\Ticket;
use App\Values\Ticket\CreateTicketRequest;
use App\Values\Ticket\UpdateTicketRequest;
use Illuminate\Pagination\LengthAwarePaginator;


interface ITicketService
{
    public function createTicket(CreateTicketRequest $createTicketRequest): Ticket;
    public function updateTicket(UpdateTicketRequest $updateTicketRequest): Ticket;
    public function getTicketById(int $id): ?Ticket;
    public function getOpenTickets(): LengthAwarePaginator;
    public function getClosedTickets(): LengthAwarePaginator;
    public function getUserTickets($email): LengthAwarePaginator;
    public function getTotalTickets(): int;
    public function getTotalUnprocessedTickets(): int;
    public function getLastProcessingTime(): string;
}