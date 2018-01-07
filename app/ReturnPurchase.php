<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnPurchase extends Model
{
    protected $fillable = [
        'status','total','remark','supplier_id'
    ];

    public $timestamps = true;

    public static function validate($id=0, $merge=[]) {
        return array_merge(
        [
            'status' => 'required',
            'total' => 'required',
            'supplier_id' => 'required'
        ], 
        $merge);
    }

    public function supplier() 
    {
        return $this->belongsTo('App\Supplier', 'supplier_id' ,'id');
    }

    public function details() 
    {
        return $this->hasMany('App\ReturnPurchaseDetail', 'return_purchase_id' ,'id');
    }
}
