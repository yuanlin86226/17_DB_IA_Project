<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as data_request;

use Exception;
use View;
use Auth;
use Redirect;
use Response;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return View::make('admin/dashboard');
        } else {
            return Redirect::action('AuthController@login');
        }
    }
}
