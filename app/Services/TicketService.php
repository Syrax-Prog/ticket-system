<?php
namespace App\Services;

use App\Models\Ticket;
use App\Models\TicketStatusLog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TicketService
{
    public function createTicket($data = array())
    {
        return DB::transaction(function () use ($data) {
            $ticket_number = 'HD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(8));
            $exists = true;

            while ($exists) {
                $ticket_number = 'HD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(8));
                $exists = Ticket::where('ticket_number', $ticket_number)->exists();
            }

            $ticket = Ticket::create([
                'title' => $data['title'],
                'category_id' => $data['category_id'],
                'priority' => $data['priority'],
                'ticket_number' => $ticket_number,
                'description' => $data['description'],
                'created_by' => 1
            ]);

            $ticket->refresh();

            TicketStatusLog::create([
                'ticket_id' => $ticket->id,
                'new_status' => $ticket->status,
                'changed_by' => $ticket->created_by
            ]);

            return $ticket;
        });
    }
}
?>