<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user',
        'book',
        'messages',
        'rating'
    ];

    public function users() {
        return $this->belongsTo('users');
    }

    public function books() {
        return $this->belongsTo('books');
    }
}
