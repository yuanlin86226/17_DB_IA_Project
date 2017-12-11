<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Role;
use App\Menu;
use App\MenuRole;
use App\MenuDetail;

use Exception;
use View;
use Auth;
use Redirect;
use Validator;
use DB;

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

    public function findOne($id)
    {
        $role = Role::find($id);
        $parents = Menu::where('parent',null)->get();

        $data['role'] = $role;
        $data['parents'] = $parents;

        return response()->json($data);
    }

    public function findroleParent()
    {
        $parents = Menu::where('parent',null)->get();

        return response()->json($parents);
    }

    public function findOneMenuDetail($id, $menu_id)
    {
        $data = array();
        $menus = Menu::where('parent',$menu_id)->get();

        foreach ($menus as $index => $menu) {
            $data[$index] = [
                'title' => $menu['title'],
                'view' => false,
                'insert' => false,
                'edit' => false,
                'delete' => false,
            ];

            $roles = DB::select(
                DB::raw("select DISTINCT sign from menu_details 
                where id in (select menu_detail_id from menu_role where menu_id = '".$menu['id']."' and role_id = '".$id."')")
            );

            foreach ($roles as $role) {
                if($role->sign == 'view') {$data[$index]['view'] = true;}
                if($role->sign == 'insert') {$data[$index]['insert'] = true;}
                if($role->sign == 'edit') {$data[$index]['edit'] = true;}
                if($role->sign == 'delete') {$data[$index]['delete'] = true;}
            }
            
        }

        return response()->json($data);
    }
}
