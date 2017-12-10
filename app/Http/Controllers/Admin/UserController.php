<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as data_request;

use App\User;
use App\RoleUser;
use App\MenuRole;
use App\MenuDetail;

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
            // menu_id要確認
            return View::make('admin/user',['menu_id'=>'2']);
        } else {
            return Redirect::action('AuthController@login');
        }
    }

    // 之後要移到RoleController底下，全部共用
    public function getRoles($id,$menu_id)
    {
        $data = array();
        $re_data = array();

        $roles = RoleUser::where('user_id', $id)->get();
        $menu_roles = MenuRole::where('menu_id',$menu_id)->get();
        $menu_details = MenuDetail::where('menu_id',$menu_id)->get();

        foreach ($roles as $role) {
            foreach ($menu_roles as $menu_role) {
                if($role['role_id'] == $menu_role['role_id'] && $menu_role['menu_detail_id']!=null ) {
                    $data[$menu_role['menu_detail_id']] = true;
                }
            }
        }

        unset($roles);
        unset($menu_roles);

        foreach ($menu_details as $menu_detail) {
            if(isset($data[$menu_detail['id']])){
                $re_data[$menu_detail['sign']] = true;
            } else {
                $re_data[$menu_detail['sign']] = false;
            }
        }

        return response()->json($re_data);

    }

    public function findAll()
    {
        $users = User::all();
        return response()->json($users);
    }
}
