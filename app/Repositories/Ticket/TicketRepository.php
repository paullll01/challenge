<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket;
use App\Values\Ticket\CreateTicketRequest;
use App\Values\Ticket\UpdateTicketRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


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

    public function findById(int $id): ?Ticket
    {
        return Ticket::find($id);
    }  

    public function update(UpdateTicketRequest $updateTicketRequest): Ticket
    {
        $ticket = Ticket::find($updateTicketRequest->getTicketId());
        $ticket->setSubject($updateTicketRequest->getSubject());
        $ticket->setContent($updateTicketRequest->getContent());
        $ticket->setUserName($updateTicketRequest->getUserName());
        $ticket->setUserEmail($updateTicketRequest->getUserEmail());
        $ticket->setStatus($updateTicketRequest->getStatus());
        $ticket->save();

        return $ticket;
    }

    public function findOpenTickets(): LengthAwarePaginator
    {
        return Ticket::where('status', false)->orderBy('created_at')->paginate(5);
    }

    public function findClosedTickets(): LengthAwarePaginator
    {
        return Ticket::where('status', true)->orderBy('created_at')->paginate(5);
    }

    public function findUserTickets($email): LengthAwarePaginator{
        return Ticket::where('user_email', $email)->orderBy('created_at')->paginate(5);
    }

    public function totalTickets(): int
    {
        return Ticket::count();
    }

    public function totalUnprocessed(): int
    {
        return Ticket::where('status', false)->count();
    }

    public function lastProcessingTime(): string
    {
        return Ticket::orderBy('updated_at', 'desc')->first()->getUpdatedAt();
    }

}