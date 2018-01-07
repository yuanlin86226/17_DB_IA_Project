<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'name','folder','discription','supplier_id'
    ];

    public $timestamps = true;

    public static function validate($id=0, $merge=[]) {
        return array_merge(
        [
            'name' => 'required',
            'folder' => 'required',
            'discription' => 'required',
            'supplier_id' => 'required'
        ], 
        $merge);
    }

    public function product()
    {
        return $this->hasMany('App\Product', 'type_id', 'id');
    }
}
