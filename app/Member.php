<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'job','name','identity_id','sex','birthday','cellphone','address','start_date','end_date'
    ];

    public $timestamps = true;

    public function parent()
    {
        return $this->belongsTo('App\Menu')->withTimestamps();
    }

    public static function validate($id=0, $merge=[]) {
        return array_merge(
        [
            'job' => 'required',
            'name' => 'required',
            'identity_id' => 'required|unique:members,identity_id' . ($id ? ",$id" : ''),
            'sex' => 'required',
            'birthday' => 'required',
            'cellphone' => 'required',
            'address' => 'required',
            'start_date' => 'required',
        ], 
        $merge);
    }
}
