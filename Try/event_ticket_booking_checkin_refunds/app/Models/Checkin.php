<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    protected $fillable = [
        'booking_id',
        'checked_in_at',
        'officer_id'
    ];

    public $timestamps = false;

    public function booking() {
        return $this->belongsTo(Booking::class);
    }

    public function officer() {
        return $this->belongsTo(User::class, 'officer_id');
    }
}
