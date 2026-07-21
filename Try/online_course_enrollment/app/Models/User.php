<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Hash;
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
    
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => bcrypt($value),
        );
    }

    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }

    public function courses() {
        return $this->hasMany(Course::class);
    }
}
