<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name','description'
    ];

    public $timestamps = true;

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    // public function menu()
    // {
    //     return $this
    //     ->belongsToMany('App\MenuDetail', 'menu_role', 'role_id', 'menu_detail_id');
    // }

    public static function validate($id=0, $merge=[]) {
        return array_merge(
        [
            'name' => 'required|unique:roles,name' . ($id ? ",$id" : ''),
            'description' => 'required'
        ], 
        $merge);
    }
}
