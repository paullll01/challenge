<?php

namespace App\Services\Ticket;

use Tests\TestCase;
use App\Models\User;
use App\Models\Ticket;
use App\Console\Commands\CreateTicket;
use App\Services\Ticket\ITicketService;
use App\Values\Ticket\CreateTicketRequest;
use PHPUnit\Framework\MockObject\MockObject;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Services\ApplicationServices\CreateTicketService;


class CreateTicketServiceTest extends TestCase
{
    private MockObject $iTicketService;
    private CreateTicketService $createTicketService;

    public function setUp(): void
    {
        parent::setUp();

        $this->iTicketService = $this->getMockBuilder(ITicketService::class)
        ->disableOriginalConstructor()
        ->getMock();

        $this->createTicketService = new CreateTicketService($this->iTicketService);

    }

    public function test_createTicketService_calls_correct_function() : void
    {
        $ticket = Ticket::factory()->create(['user_email' => 'test@test.com']);

        $this->iTicketService->expects(self::once())
            ->method('createTicket')
            ->willReturn($ticket);

        $createTicketRequest = new CreateTicketRequest(
            subject :'Test Subject',
            content :'Test Content',
            user_name :'Test User',
            user_email : 'test@test.com',
            status : false
        );

        $this->createTicketService->execute($createTicketRequest);

    }
}