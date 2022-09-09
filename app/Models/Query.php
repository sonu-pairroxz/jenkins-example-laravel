<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    use HasFactory, Uuid;
    protected $fillable = ["ticket_id","user_id","title","description","asin","work_stream","marketplace","tariff_node","manager_id","ruling_referred","external_links","document_referred","no_of_nfa_parked","itk","requester_comment","resolver_comment"];

    public function user(){
        return $this->belongsTo(Admin::class, 'user_id');
    }

    public function notification(){
        return $this->hasOne(Notification::class, 'query_id');
    }
}
