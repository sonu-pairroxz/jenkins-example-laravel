<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory, Uuid;
    protected $fillable = [
        'user_id',
        'title',
        'marketplace',
        'type',
        'date_of_publish',
        'date_of_change_applied',
        'description',
    ];
}
