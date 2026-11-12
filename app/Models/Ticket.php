<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Ticket extends Model
{
    protected $fillable = [
        'ticket_number',
        'title',
        'description',
        'category_id',
        'priority',
        'status',
        'created_by',
        'updated_by',
        'assigned_to',
        'assigned_at',
        'resolved_at',
        'closed_at',
        'resolution_details'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function statusLogs()
    {
        return $this->hasMany(TicketStatusLog::class, 'ticket_id');
    }
}
