<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'created_by',
        'updated_by'
    ];
    
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
