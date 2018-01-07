<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id','product_id','name','price','num'
    ];

    public $timestamps = true;

    public static function validate($id=0, $merge=[]) {
        return array_merge(
        [
            'order_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'num' => 'required'
        ], 
        $merge);
    }
}
