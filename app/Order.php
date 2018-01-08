<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'status','payment_method','discount','total','remark','customer_id','back_order_id'
    ];

    public $timestamps = true;

    public static function validate($id=0, $merge=[]) {
        return array_merge(
        [
            'status' => 'required',
            'total' => 'required',
            'customer_id' => 'required'
        ], 
        $merge);
    }

    public function details() 
    {
        return $this->hasMany('App\OrderDetail', 'order_id' ,'id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id' ,'id');
    }
}
