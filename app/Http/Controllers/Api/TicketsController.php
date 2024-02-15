<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Ticket\ITicketService;
use App\Services\User\IUserService;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function __construct(
        private ITicketService $ticketService,
        private IUserService $userService
    ){
    }
    public function openTickets()
    {
        $tickets = $this->ticketService->getOpenTickets();
        
        return response()->json(['tickets' => $tickets]);
    }

    public function closedTickets()
    {
        $tickets = $this->ticketService->getClosedTickets();
        
        return response()->json(['tickets' => $tickets]);
    }

    public function getUserTickets(Request $request, string $email)
    {
        $tickets = $this->ticketService->getUserTickets($email);
        
        return response()->json(['tickets' => $tickets]);
    }

    public function stats()
    {
        $totalTickets = $this->ticketService->getTotalTickets();
        $totalUnprocessedTickets = $this->ticketService->getTotalUnprocessedTickets();
        $userWithMostTickets = $this->userService->getUserWithMostTickets();
        $lastProcessingTime = $this->ticketService->getLastProcessingTime();
        
        return response()->json([
            'totalTickets' => $totalTickets,
            'totalUnprocessedTickets' => $totalUnprocessedTickets,
            'userWithMostTickets' => $userWithMostTickets,
            'lastProcessingTime' => $lastProcessingTime
        ]);
    }
    
}
