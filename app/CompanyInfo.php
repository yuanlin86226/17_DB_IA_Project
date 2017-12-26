<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    protected $fillable = [
        'name','tax','website','email','fax','telephone','address','ceo'
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
            'ceo' => 'required'
        ], 
        $merge);
    }
}
