<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Auth;
use Redirect;
use View;

class AuthController extends Controller
{
    public function index(){
    	return View::make('login');
    }

    public function login(Request $request){
        $authData = $request->only(['username', 'password']);

        if (empty($request->username) || empty($request->password)) {
        	return Redirect::back()->withErrors(['msg'=>'請輸入完整資料']);
        }
        elseif (Auth::attempt($authData, $request->remember)) {
            date_default_timezone_set('Asia/Taipei');
            $lastLoginAt=date("Y-m-d H:i:s");
            Auth::user() -> lastLoginAt = $lastLoginAt;

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            Auth::user() -> lastLoginIP = $ip;

            Auth::user() -> lastLoginAgent = $_SERVER['HTTP_USER_AGENT'];

            Auth::user() -> save();

            return Redirect::action('Admin\UserController@index');
        }
        else {
        	$user = User::where('userName', $request->username)->get();

        	if (count($user)==0) {
        		return Redirect::back()->withErrors(['msg'=>'查無此帳號'])->withInput($request->except('password'));
        	}
        	else {
        		return Redirect::back()->withErrors(['msg'=>'密碼錯誤'])->withInput($request->except('password'));
        	}
        }
    }

    public function logout(){
    	Auth::logout();
    	return Redirect::action('AuthController@index');
    }
}
