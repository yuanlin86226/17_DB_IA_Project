<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'icon','title','href','parent','order'
    ];

    public $timestamps = true;

}
