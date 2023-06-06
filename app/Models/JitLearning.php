<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JitLearning extends Model
{
    use HasFactory, Uuid;
    protected $fillable = [
        'user_id',
        'ticket_id',
        'asin',
        'product_name',
        'keywords',
        'error_type',
        'sim',
        'node',
        'marketplace',
        'correct_code',
        'incorrect_code',
        'learning',
        'correct_methodology',
        'reference',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    //notification
    public function notification(){
        return $this->hasMany(JitLearningNotification::class);
    }
}
