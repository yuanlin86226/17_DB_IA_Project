<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuDetail extends Model
{
    protected $fillable = [
        'menu_id','sign','description'
    ];

    public $timestamps = true;
}
