<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Uuid, HasFactory, Notifiable, HasRoles;

    protected $table = 'users';
    protected $guard = 'admin';
    protected $guarded = array();
    protected $hiddenAttributes = ['password','remember_token'];

    public function userQuery(){
        return $this->hasMany(Query::class, 'user_id');
    }
    public function jitLearning(){
        return $this->hasMany(JitLearning::class, 'user_id');
    }

    //news
    public function news(){
        return $this->hasMany(News::class, 'user_id');
    }
}
