<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Htus extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'ruling_reference',
        'issuing_country',
        'start_date_of_validity',
        'end_date_of_validity',
        'nomenclature_code',
        'short_nomenclature_code',
        'classification_justification',
        'language',
        'place_of_issue',
        'date_of_issue',
        'name_address',
        'description_0f_goods',
        'keywords',
        'eccn',
        'image_url',
        'amazon_doc',
        'chapter_note',
        'comments',
        'image'
    ];
}
