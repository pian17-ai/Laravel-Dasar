<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
        return $this->hasMany(Event::class, 'created_by');
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}
