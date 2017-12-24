<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuRole extends Model
{
    protected $table = 'menu_role';
    
    protected $fillable = [
        'menu_id', 'menu_detail_id', 'role_id'
    ];

    public $timestamps = true;
}
