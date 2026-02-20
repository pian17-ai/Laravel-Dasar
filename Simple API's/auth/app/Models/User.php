<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasApiTokens;

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'birth_date',
        'role_id'
    ];

    public function role() {
        return $this->belongsTo(Role::class);
    }
}
