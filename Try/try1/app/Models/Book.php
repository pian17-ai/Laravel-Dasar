<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'writter',
        'publisher',
        'pages',
        'category'
    ];

    public function categories() {
        return $this->belongsTo('categories');
    }

    public function reviews() {
        return $this->hasMany('reviews');
    }
}
