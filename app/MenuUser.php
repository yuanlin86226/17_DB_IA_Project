<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuUser extends Model
{
    protected $table = 'menu_user';
    
    protected $fillable = [
        'menu_id', 'menu_detail_id', 'user_id'
    ];

    public $timestamps = true;
}
