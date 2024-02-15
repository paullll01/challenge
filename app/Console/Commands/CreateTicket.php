<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use App\DTO\TicketResponse;
use Illuminate\Console\Command;
use App\Values\Ticket\CreateTicketRequest;
use App\Services\ApplicationServices\CreateTicketService;


class CreateTicket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:ticket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a new ticket';

    /**
     * Execute the console command.
     */
    public function handle(CreateTicketService $createTicketService)
    {
        $ticketData = Ticket::factory()->make();

        $createTicket = CreateTicketRequest::validateAndCreate($ticketData);

        $ticket = $createTicketService->execute($createTicket);

        $ticketResponse = new TicketResponse(
            id: $ticket->getId(),
            subject: $ticket->getSubject(),
            content: $ticket->getContent(),
            user_name: $ticket->getUserName(),
            user_email: $ticket->getUserEmail(),
            status: $ticket->getStatus()
        );
        
        $this->info('Ticket created successfully');
        $this->line(json_encode($ticketResponse, JSON_PRETTY_PRINT));
        
    }
}
