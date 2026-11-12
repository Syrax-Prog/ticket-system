<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Services\TicketService;
use Illuminate\Support\Facades\Auth;


class TicketController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('tickets.create', compact('categories'));
    }

    public function store(Request $r, TicketService $ticket_s)
    {
        $data = $r->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'priority' => 'required'
        ]);

        $ticket_s->createTicket($data);
        return redirect('/tickets');
    }

    public function index()
    {
        $ticket = Ticket::orderByRaw('COALESCE(updated_at, created_at) DESC')->paginate(10);
        return view('tickets.show', compact('ticket'));
    }
}
