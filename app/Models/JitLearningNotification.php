<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JitLearningNotification extends Model
{
    use HasFactory, Uuid;
    protected $fillable = ["jit_learning_id", "user_id","title","description","notification_text",'read_status'];

    public function user(){
        return $this->hasOne(User::class, 'user_id');
    }

    public function jitLearning(){
        return $this->belongsTo(JitLearning::class, "jit_learning_id");
    }
}
