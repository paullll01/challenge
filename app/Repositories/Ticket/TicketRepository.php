<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket;
use App\Values\Ticket\CreateTicketRequest;


class TicketRepository implements ITicketRepository
{
    public function create(CreateTicketRequest $createTicketRequest) : Ticket
    {
        $ticket = new Ticket();
        $ticket->setSubject($createTicketRequest->getSubject());
        $ticket->setContent($createTicketRequest->getContent());
        $ticket->setUserName($createTicketRequest->getUserName());
        $ticket->setUserEmail($createTicketRequest->getUserEmail());
        $ticket->setStatus($createTicketRequest->getStatus());
        $ticket->save();

        return $ticket;
    }
}