<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $fillable = [
        'title',
        'location',
        'event_date',
        'price',
        'created_by'
    ];

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}
