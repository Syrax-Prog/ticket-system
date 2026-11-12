<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $r)
    {
        $status = in_array($r->query('status'), array('open', 'assigned', 'closed')) ? $r->query('status') : '';

        if (!empty($status)) {
            $ticket = Ticket::where('status', $status)->orderByRaw('COALESCE(updated_at, created_at) DESC')->paginate(10);
        } else {
            $ticket = Ticket::orderByRaw('COALESCE(updated_at, created_at) DESC')->paginate(10);
        }

        return response()->json($ticket);
    }
}