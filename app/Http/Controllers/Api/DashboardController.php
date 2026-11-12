<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $total_ticket = Ticket::count();

        //status
        $open = array(
            'name' => 'Open',
            'count' => Ticket::where('status', 'open')->count(),
            'color' => 'secondary',
            'icon' => 'bi-folder'
        );

        $assigned = array(
            'name' => 'Assigned',
            'count' => Ticket::where('status', 'assigned')->count(),
            'color' => 'info',
            'icon' => 'bi-person-check'
        );

        $closed = array(
            'name' => 'Closed',
            'count' => Ticket::where('status', 'closed')->count(),
            'color' => 'dark',
            'icon' => 'bi-lock'
        );

        //priority
        $low = array(
            'name' => 'Low',
            'count' => Ticket::where('priority', 'Low')->count(),
            'color' => 'success'
        );

        $medium = array(
            'name' => 'Medium',
            'count' => Ticket::where('priority', 'Medium')->count(),
            'color' => 'info'
        );

        $high = array(
            'name' => 'High',
            'count' => Ticket::where('priority', 'High')->count(),
            'color' => 'warning'
        );

        $urgent = array(
            'name' => 'Urgent',
            'count' => Ticket::where('priority', 'Urgent')->count(),
            'color' => 'danger'
        );

        //this month statistic
        $resolve_cur_month = Ticket::where('status', 'closed')
            ->whereMonth('resolved_at', now()->month)
            ->whereYear('resolved_at', now()->year)
            ->count();

        $open_cur_month = Ticket::where('status', 'open')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $average_time = 0;
        if (Ticket::where('status', 'closed')) {
            $average_time = round(Ticket::where('status', 'closed')->whereNotNull('resolved_at')->selectRaw('AVG(EXTRACT(EPOCH FROM (resolved_at - created_at))) AS average_seconds')->value('average_seconds') / 3600, 2);
        }

        $resolution_rate = 0;
        if (Ticket::where('status', 'closed')->count() > 0) {
            $resolution_rate = round(($resolve_cur_month / $total_ticket) * 100, 2);
        }

        $recent_ticket = Ticket::where('status', 'open')->limit(5)->orderBy('created_at', 'DESC')->get();

        $data = array(
            'total_ticket' => $total_ticket,
            'today_date' => now()->format('d F Y'),
            'status' => array($open, $assigned, $closed),
            'priority' => array($low, $medium, $high, $urgent),
            'resolution' => array(
                'resolved' => $resolve_cur_month,
                'open' => $open_cur_month,
                'average_time' => $average_time,
                'rate' => $resolution_rate
            ),
            'recent' => $recent_ticket
        );

        return response()->json($data);
    }
}