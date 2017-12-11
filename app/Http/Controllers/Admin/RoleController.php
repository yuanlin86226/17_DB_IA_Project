<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Role;

use Exception;
use View;
use Auth;
use Redirect;
use Validator;

class RoleController extends Controller
{
    public function index()
    {
        if (Auth::check()) {

            // menu_id要確認
            $menu_id = 3;
            $user_id = Auth::user()->id;

            $role_menus = User::able_page($user_id, $menu_id);

            if (count($role_menus)==0) {
                return Redirect::action('AuthController@login');
            } else {
                return View::make('admin/role',['menu_id' => $menu_id]);
            }

            
            return View::make('admin/user',['menu_id' => $menu_id]);
        } else {
            return Redirect::action('AuthController@login');
        }
    }

    public function findAll()
    {
        $roles = Role::all();

        return response()->json($roles);
    }
}
