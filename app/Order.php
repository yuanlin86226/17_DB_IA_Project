<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'payment_method','discount','total','remark','customer_id'
    ];

    public $timestamps = true;

    public static function validate($id=0, $merge=[]) {
        return array_merge(
        [
            'payment_method' => 'required',
            'total' => 'required',
            'customer_id' => 'required'
        ], 
        $merge);
    }
}
