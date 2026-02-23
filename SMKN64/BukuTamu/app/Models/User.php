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
        'role',
        'role'
    ];

    public $timestamps = false;

    public function guestBook() {
        return $this->hasOne(GuestBook::class);
    }
}
