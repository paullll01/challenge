<?php 

namespace App\Services\Ticket;

use App\Models\Ticket;
use App\Values\Ticket\CreateTicketRequest;
use App\Values\Ticket\UpdateTicketRequest;
use App\Repositories\Ticket\ITicketRepository;
use Illuminate\Pagination\LengthAwarePaginator;


class TicketService implements ITicketService
{

    public function __construct(
        private ITicketRepository $ticketRepository
    ){
    }
    
    public function createTicket(CreateTicketRequest $createTicketRequest) : Ticket
    {
        return $this->ticketRepository->create($createTicketRequest);
    }

    public function getTicketById(int $id): ?Ticket
    {
        return $this->ticketRepository->findById($id);
    }

    public function updateTicket(UpdateTicketRequest $updateTicketRequest): Ticket
    {
        return $this->ticketRepository->update($updateTicketRequest);
    }

    public function getOpenTickets(): LengthAwarePaginator
    {
        return $this->ticketRepository->findOpenTickets();
    }

    public function getClosedTickets(): LengthAwarePaginator
    {
        return $this->ticketRepository->findClosedTickets();
    }

    public function getUserTickets($email): LengthAwarePaginator{
        return $this->ticketRepository->findUserTickets($email);
    }

    public function getTotalTickets(): int
    {
        return $this->ticketRepository->totalTickets();
    }

    public function getTotalUnprocessedTickets(): int
    {
        return $this->ticketRepository->totalUnprocessed();
    }

    public function getLastProcessingTime(): string
    {
        return $this->ticketRepository->lastProcessingTime();
    }
}