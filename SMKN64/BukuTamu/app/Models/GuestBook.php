<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestBook extends Model
{
    protected $fillable = [
        'user_id',
        'message',
        'image',
        'is_approved',
        'is_pinned'
    ];

    public $timestamps = false;

    public function User() {
        return $this->belongsTo(User::class);
    }
}