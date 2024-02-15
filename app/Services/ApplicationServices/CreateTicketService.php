<?php

namespace App\Services\ApplicationServices;

use App\Models\Ticket;
use App\Services\Ticket\ITicketService;
use App\Values\Ticket\CreateTicketRequest;

class CreateTicketService
{
    public function __construct(
        private ITicketService $ticketService
    ){
    }

    public function execute(CreateTicketRequest $createTicketRequest) : Ticket
    {
        return $this->ticketService->createTicket($createTicketRequest);
    }
}