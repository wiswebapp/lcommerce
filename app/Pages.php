<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $fillable = [
        'page_title', 'page_description', 'page_meta_keyword','page_meta_description', 'page_image','status'
    ];
}
