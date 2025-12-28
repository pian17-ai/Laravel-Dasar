<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'location',
        'event_date',
        'created_by'
    ];

    public $timestamps = false;

    public function creator() {
        $this->belongsTo(User::class, 'created_by');
    }
}
