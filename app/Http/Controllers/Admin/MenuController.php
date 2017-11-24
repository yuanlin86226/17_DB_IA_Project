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

class MenuController extends Controller
{
    public function menu_list($user_id){
        
        $role_id = RoleUser::selectRaw('role_id')->where('user_id',$user_id)->get();
        $role_menus = MenuRole::selectRaw('menu_id')->where('role_id',$role_id[0]['role_id'])->groupBy('menu_id')->orderby('menu_id')->get();

        // $event_applys = DB::select(
        //     DB::raw("select A.m_account, C.num, B.name, B.value
        //         from event_applies as A,
        //             event_apply_details as B,
        //             (
        //                 select @r:=@r+1 as `num` , B.name 
        //                 from
        //                     (select DISTINCT name from event_apply_details 
        //                     where `event_apply_id` in 
        //                         (select `id` from `event_applies` where `event` = '".$event_id."')
        //                     ) as B, 
        //                     (select @r:=0) as rownum
        //             ) as C
        //         where A.event = '".$event_id."' and A.id = B.event_apply_id and C.name = B.name
        //         group by A.m_account, B.name, B.value, C.num
        //         order by A.m_account ,C.num")
        // );
        
        $menu_list = array();

        // $menu_list = Menu::where('role_id',$role_id[0]['role_id']);
        $p_num = 0;
        // dd($menu_list);

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
