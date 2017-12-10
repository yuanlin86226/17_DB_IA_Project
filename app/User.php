<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userName', 'name', 'email', 'password', 'phoneNumber', 'remark', 'lastLoginAt', 'lastLoginIP', 'lastLoginAgent'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    private $rules = [
        'userName' => 'unique:users,userName',
        'email' => 'unique:users,email'
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

    public static function validate($id=0, $merge=[]) {
        return array_merge(
        [
            'userName' => 'required|unique:users,userName' . ($id ? ",$id" : ''),
            'email' => 'required|email|unique:users,email' . ($id ? ",$id" : '')
        ], 
        $merge);
    }
}
