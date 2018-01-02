<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','photo','price','total_amount','inventory','sales_amount'
    ];

    public $timestamps = true;

    public static function validate($id=0, $merge=[]) {
        return array_merge(
        [
            'name' => 'required',
            'photo' => 'required',
            'price' => 'required',
            'total_amount' => 'required',
            'inventory' => 'required',
            'sales_amount' => 'required'
        ], 
        $merge);
    }
}
