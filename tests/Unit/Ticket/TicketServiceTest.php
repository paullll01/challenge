<?php   

namespace Tests\Unit\Ticket;

use Mockery;
use Tests\TestCase;
use App\Models\Ticket;
use App\Services\Ticket\TicketService;
use App\Values\Ticket\CreateTicketRequest;
use App\Values\Ticket\UpdateTicketRequest;
use App\Repositories\Ticket\TicketRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketServiceTest extends TestCase
{
    use RefreshDatabase;
    
    private TicketService $ticketService;
    private TicketRepository $ticketRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->ticketRepository = new TicketRepository;
        $this->ticketService = new TicketService($this->ticketRepository);
    }

    public function test_ticket_returns_correct_data() : void
    {
        $createTicketRequest = new CreateTicketRequest(
            subject :'Test Subject',
            content :'Test Content',
            user_name :'Test User',
            user_email : 'test@test.com',
            status : false
        );

        $ticket = $this->ticketService->createTicket($createTicketRequest);

        $this->assertEquals('Test Subject', $ticket->getSubject());
        $this->assertEquals('Test Content', $ticket->getContent());
        $this->assertEquals('Test User', $ticket->getUserName());
        $this->assertEquals('test@test.com', $ticket->getUserEmail());
        $this->assertEquals(false, $ticket->getStatus());

    }

    public function test_getTicketById_returns_correct_data() : void
    {
        $ticket = Ticket::factory()->create();

        $responseTicket = $this->ticketService->getTicketById($ticket->id);

        $this->assertEquals($ticket->id, $responseTicket->getId());
        $this->assertEquals($ticket->subject, $responseTicket->getSubject());
        $this->assertEquals($ticket->content, $responseTicket->getContent());
        $this->assertEquals($ticket->user_name, $responseTicket->getUserName());
        $this->assertEquals($ticket->user_email, $responseTicket->getUserEmail());
        $this->assertEquals($ticket->status, $responseTicket->getStatus());

    }

    public function test_getTicketById_returns_null_when_ticket_not_found() : void
    {
        $responseTicket = $this->ticketService->getTicketById(999);

        $this->assertEquals(null, $responseTicket);
    }

    public function test_updateTicket_returns_correct_data() : void
    {
        $ticket = Ticket::factory()->create();

        $updateTicketRequest = new UpdateTicketRequest(
            id : $ticket->id,
            subject :'Updated Subject',
            content :'Updated Content',
            user_name :'Updated User',
            user_email : 'test@test.com',
            status : true
        );

        $responseTicket = $this->ticketService->updateTicket($updateTicketRequest);

        $this->assertEquals($ticket->id, $responseTicket->getId());
        $this->assertEquals('Updated Subject', $responseTicket->getSubject());
        $this->assertEquals('Updated Content', $responseTicket->getContent());
        $this->assertEquals('Updated User', $responseTicket->getUserName());
        $this->assertEquals('test@test.com', $responseTicket->getUserEmail());
        $this->assertEquals(true, $responseTicket->getStatus());

    }

    public function test_getOpenTickets_returns_correct_data() : void
    {
        Ticket::factory()->count(5)->create(['status' => false]);

        $responseTickets = $this->ticketService->getOpenTickets();

        $this->assertInstanceOf(LengthAwarePaginator::class, $responseTickets);
        $this->assertEquals(5, $responseTickets->count());
    }

    public function test_getClosedTickets_returns_correct_data() : void
    {
        Ticket::factory()->count(5)->create(['status' => true]);

        $responseTickets = $this->ticketService->getClosedTickets();

        $this->assertInstanceOf(LengthAwarePaginator::class, $responseTickets);
        $this->assertEquals(5, $responseTickets->count());
    }

    public function test_getUserTickets_returns_correct_data() : void
    {
        Ticket::factory()->count(5)->create(['user_email' => 'test@test.com']);

        $responseTickets = $this->ticketService->getUserTickets('test@test.com');

        $this->assertInstanceOf(LengthAwarePaginator::class, $responseTickets);
        $this->assertEquals(5, $responseTickets->count());
    }

    public function test_totalTickets_returns_correct_data() : void
    {
        Ticket::factory()->count(5)->create();

        $totalTickets = $this->ticketService->getTotalTickets();

        $this->assertEquals(5, $totalTickets);
    }

    public function test_totalUnprocessed_returns_correct_data() : void
    {
        Ticket::factory()->count(5)->create(['status' => false]);

        $totalUnprocessed = $this->ticketService->getTotalUnprocessedTickets();

        $this->assertEquals(5, $totalUnprocessed);
    }

    public function test_lastProcessingTime_returns_correct_data() : void
    {
        Ticket::factory()->create(['status' => true, 'updated_at' => now()->subDays(3)]);
        Ticket::factory()->create(['status' => true, 'updated_at' => now()->subDays(2)]);
        Ticket::factory()->create(['status' => true, 'updated_at' => now()->subDays(1)]);

        $lastProcessingTime = $this->ticketService->getLastProcessingTime();

        $this->assertEquals(now()->subDays(1)->format('Y-m-d H:i:s'), $lastProcessingTime);
    }

}