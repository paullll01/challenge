<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use App\DTO\TicketResponse;
use Illuminate\Console\Command;
use App\Values\Ticket\UpdateTicketRequest;
use App\Services\ApplicationServices\UpdateTicketService;

class UpdateTicket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:ticket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update a ticket status';

    /**
     * Execute the console command.
     */
    public function handle(UpdateTicketService $updateTicketService)
    {
        $ticketData = Ticket::where('status', false)->orderBy('created_at')->first();

        $ticketData->setStatus(true);

        $updateTicketRequest = UpdateTicketRequest::validateAndCreate($ticketData);

        $ticket = $updateTicketService->execute($updateTicketRequest);

        $ticketResponse = new TicketResponse(
            id: $ticket->getId(),
            subject: $ticket->getSubject(),
            content: $ticket->getContent(),
            user_name: $ticket->getUserName(),
            user_email: $ticket->getUserEmail(),
            status: $ticket->getStatus()
        );

        $this->info('Ticket updated successfully');
        $this->line(json_encode($ticketResponse, JSON_PRETTY_PRINT));

    }
}
