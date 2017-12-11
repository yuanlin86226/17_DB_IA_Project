<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'icon','title','href','parent','order'
    ];

    public $timestamps = true;

    public function parent()
    {
        return $this->belongsTo('App\Menu')->withTimestamps();
    }

    public static function validate($id=0, $merge=[]) {
        return array_merge(
        [
            'title' => 'required|unique:menus,title' . ($id ? ",$id" : ''),
            'icon' => 'required'
        ], 
        $merge);
    }

}
