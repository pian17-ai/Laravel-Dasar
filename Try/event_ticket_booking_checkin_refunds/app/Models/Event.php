<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'start_time',
        'end_time',
        'created_by',
        'is_active'
    ];

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }
}
