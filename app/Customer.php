<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name','sex','birthday','email','cellphone','address'
    ];

    public $timestamps = true;

    public static function validate($id=0, $merge=[]) {
        return array_merge(
        [
            'name' => 'required',
            'sex' => 'required',
            'birthday' => 'required',
            'email' => 'required',
            'cellphone' => 'required',
            'address' => 'required'
        ], 
        $merge);
    }
}
