<?php 

namespace App\Services\Ticket;

use App\Models\Ticket;
use App\Values\Ticket\CreateTicketRequest;
use App\Repositories\Ticket\ITicketRepository;


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

}