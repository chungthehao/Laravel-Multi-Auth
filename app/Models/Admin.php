<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $guard = 'admin';
    protected $guarded = [];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
