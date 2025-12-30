<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $fillable = [
        'booking_id',
        'reason',
        'refunded_at'
    ];

    public $timestamps = false;

    public function booking() {
        return $this->belongsTo(Booking::class);
    }
}
