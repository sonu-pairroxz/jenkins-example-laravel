<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use \Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    const ADMIN_TYPE = 'admin';
    const USER_TYPE = 'user';

    use Uuid, HasFactory, Notifiable, HasApiTokens, HasRoles;
    protected $guard = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile_no',
        'is_newsletter',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ["fullname"];

    public function getFullNameAttribute(){
        return $this->first_name .' '.$this->last_name;
    }
    public function isUser(){
        return $this->role === self::USER_TYPE;
    }

    public function isAdmin(){
        return $this->role === self::ADMIN_TYPE;
    }

    public function address(){
        return $this->hasOne(UserAddress::class,'user_id');
    }
}
