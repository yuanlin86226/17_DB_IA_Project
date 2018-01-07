<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name','tax','ceo','telephone','fax','email','address','website','supplier_id'
    ];

    public $timestamps = true;

    public static function validate($id=0, $merge=[]) {
        return array_merge(
        [
            'name' => 'required',
            'tax' => 'required',
            'email' => 'required',
            'fax' => 'required',
            'telephone' => 'required',
            'address' => 'required',
            'ceo' => 'required',
            'supplier_id' => 'required'
        ], 
        $merge);
    }
}
