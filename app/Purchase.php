<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'discount','total','remark','supplier_id'
    ];

    public $timestamps = true;

    public static function validate($id=0, $merge=[]) {
        return array_merge(
        [
            'total' => 'required',
            'supplier_id' => 'required'
        ], 
        $merge);
    }

    public function details() 
    {
        return $this->hasMany('App\PurchaseDetail', 'purchase_id' ,'id');
    }

    public function supplier() 
    {
        return $this->belongsTo('App\Supplier', 'supplier_id' ,'id');
    }
}
