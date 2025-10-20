<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Login extends Authenticatable
{
    use Notifiable;

    protected $table = 'login';

    protected $fillable = ['fullname', 'email', 'password'];

    protected $hidden = ['password'];
}
