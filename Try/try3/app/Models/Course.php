<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'created_by'
    ];

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function enrollment() {
        return $this->hasMany(Enrollments::class);
    }
}
