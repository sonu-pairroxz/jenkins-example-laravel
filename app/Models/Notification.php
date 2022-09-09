<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory, Uuid;
    protected $fillable = ["query_id", "user_id","title","description","notification_text",'read_status'];

    public function user(){
        return $this->hasOne(User::class, 'user_id');
    }

    public function userQuery(){
        return $this->belongsTo(Query::class, "query_id");
    }


}
