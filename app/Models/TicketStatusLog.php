<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;
use App\Models\User;

class TicketStatusLog extends Model
{
    protected $fillable = [
        'ticket_id',
        'old_status',
        'new_status',
        'changed_by'
    ];

    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by');

    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}
