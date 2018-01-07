<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $fillable = [
        'purchase_id','product_id','name','price','num'
    ];

    public $timestamps = true;

    public static function validate($id=0, $merge=[]) {
        return array_merge(
        [
            'purchase_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'num' => 'required'
        ], 
        $merge);
    }
}
