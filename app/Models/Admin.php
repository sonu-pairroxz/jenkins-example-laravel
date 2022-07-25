<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use Uuid, HasFactory, Notifiable;

    protected $table = 'users';
    protected $guard = 'admin';
    protected $guarded = array();
    protected $hiddenAttributes = ['password','remember_token'];
}
