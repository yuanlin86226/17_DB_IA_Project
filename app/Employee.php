<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'job','name','identity_id','sex','birthday','email','cellphone','address','start_date','status','end_date'
    ];

    public $timestamps = true;

    public static function validate($id=0, $merge=[]) {
        return array_merge(
        [
            'job' => 'required',
            'name' => 'required',
            'identity_id' => 'required|unique:employees,identity_id' . ($id ? ",$id" : ''),
            'sex' => 'required',
            'birthday' => 'required',
            'email' => 'required',
            'cellphone' => 'required',
            'address' => 'required',
            'start_date' => 'required',
            'status' => 'required',
        ], 
        $merge);
    }
}
