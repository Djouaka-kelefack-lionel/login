<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    protected $fillable = [
        'username',
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password'
    ];
}
