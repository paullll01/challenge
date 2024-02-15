<?php

namespace App\Services\ApplicationServices;

use App\Console\Commands\UpdateTicket;
use App\Services\Ticket\ITicketService;
use App\Values\Ticket\UpdateTicketRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UpdateTicketService
{

    public function __construct(
        private ITicketService $ticketService
    ) {
    }

    public function execute(UpdateTicketRequest $updateTicketRequest)
    {
        $ticket = $this->ticketService->getTicketById($updateTicketRequest->getTicketId());

        if (null === $ticket) {
            throw new NotFoundHttpException('Ticket not found');
        }

        $updateTicket = new UpdateTicketRequest(
            $updateTicketRequest->getTicketId(),
            $updateTicketRequest->getSubject(),
            $updateTicketRequest->getContent(),
            $updateTicketRequest->getUserName(),
            $updateTicketRequest->getUserEmail(),
            $updateTicketRequest->getStatus()
        );

        $ticket = $this->ticketService->updateTicket($updateTicket);

        return $ticket;
        
    }

}