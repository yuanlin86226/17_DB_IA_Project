<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnPurchaseDetail extends Model
{
    protected $fillable = [
        'return_purchase_id','product_id','name','price','num'
    ];

    public $timestamps = true;

    public static function validate($id=0, $merge=[]) {
        return array_merge(
        [
            'return_purchase_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'num' => 'required'
        ], 
        $merge);
    }
}
