<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'ticket_id',
        'status',
        'booked_at'
    ];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function ticket() {
        return $this->belongsTo(Ticket::class);
    }

    public function checkin() {
        return $this->hasOne(Checkin::class);
    }

    public function refund() {
        return $this->hasOne(Refund::class);
    }
}
