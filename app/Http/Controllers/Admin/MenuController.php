<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as data_request;

use App\Menu;
use App\MenuRole;
use App\RoleUser;

use Exception;
use View;
use Auth;
use Redirect;
use Request;
use DB;

class MenuController extends Controller
{
    public function menu_list($user_id){

        $role_menus = DB::select(
            DB::raw("select DISTINCT menu_id from menu_role 
            where role_id in (select role_id from role_user where user_id = '".$user_id."')")
        );
        
        $menu_list = array();

        $p_num = 0;

        $role_menus = json_decode(json_encode($role_menus), true);

        foreach ($role_menus as $menu) {
            $menu_data = Menu::find($menu['menu_id']);

            if ($menu_data['parent'] == null) {
                
                $menu_list[$p_num] = $menu_data;
                $menu_list[$p_num]['childs'] = array();

                $p_num++;                
            } else {
                for ($i = 0; $i < $p_num; $i++) {
                    if($menu_list[$i]['id'] == $menu_data['parent']) {
                        $menu_data['childs'] = array();
                        $menu_list[$i]['childs'] = array_merge($menu_list[$i]['childs'],array(json_decode($menu_data,true)));
                    }
                }
            }
        }

        return response()->json($menu_list);
    }
}
