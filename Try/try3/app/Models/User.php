<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    public function enrollments() {
        return $this->hasMany(Enrollments::class);
    }

    public function courses() {
        return $this->hasMany(Course::class);
    }
}
