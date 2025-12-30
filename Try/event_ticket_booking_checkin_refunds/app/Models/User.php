<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as AuthUser;
use Laravel\Sanctum\HasApiTokens;

class User extends AuthUser
{
    use HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    public function events() {
        return $this->hasMany(Event::class);
    }

    public function booking() {
        return $this->hasMany(Booking::class);
    }

    public function checkin() {
        return $this->hasMany(Checkin::class);
    }
}
