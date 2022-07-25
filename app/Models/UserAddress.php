<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ["user_id","first_name","last_name","mobile_no","email","address","city","state","country","latitude","longitude","zipcode"];

    protected $appends = ['full_name'];

    public function getFullNameAttribute(){
        return $this->first_name .' '.$this->last_name;
    }
}
