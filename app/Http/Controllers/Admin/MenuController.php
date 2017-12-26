<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as data_request;

use App\User;
use App\Menu;
use App\MenuRole;
use App\MenuDetail;
use App\RoleUser;

use Exception;
use Validator;
use View;
use Auth;
use Redirect;
use Request;
use DB;

class MenuController extends Controller
{
    public function index()
    {
        if (Auth::check()) {

            // menu_id要確認
            $menu_id = 4;
            $user_id = Auth::user()->id;

            $role_menus = User::able_page($user_id, $menu_id);

            if (count($role_menus)==0) {
                return Redirect::action('AuthController@login');
            } else {
                return View::make('admin/menu',['menu_id' => $menu_id]);
            }

        } else {
            return Redirect::action('AuthController@login');
        }
    }

    public function findAll() 
    {
        $parent = Request::get('parent');
        $menus = Menu::where('parent',$parent)->get();

        return response()->json($menus);
    }

    public function findOne($id)
    {
        $menus = Menu::find($id);

        return response()->json($menus);
    }

    public function save(data_request $request)
    {
        try {
            $menu = [
                'icon' => $request["icon"],
                'title' => $request["title"],
                'href' => $request["href"],
                'parent' => $request['parent']
            ];
            
            $validator = Validator::make($menu, Menu::validate());
            
            if ($validator->fails())
            {
                $error_msg = "";
                $error = $validator->errors();
                foreach ($error->all() as $message) {
                    $error_msg = $error_msg . $message;
                }

                $data['result'] = false;
                $data['message'] = $error_msg;
                
            } else {
                // 建立資料
                $createdMenu = Menu::create($menu);
                
                if($menu['parent']!="" || $menu['parent']!=null){
                    MenuDetail::create([
                        'menu_id' => $createdMenu['id'],
                        'sign' => 'view',
                        'description' => '檢視'
                    ]);
                    MenuDetail::create([
                        'menu_id' => $createdMenu['id'],
                        'sign' => 'insert',
                        'description' => '新增'
                    ]);
                    MenuDetail::create([
                        'menu_id' => $createdMenu['id'],
                        'sign' => 'edit',
                        'description' => '修改'
                    ]);
                    MenuDetail::create([
                        'menu_id' => $createdMenu['id'],
                        'sign' => 'delete',
                        'description' => '刪除'
                    ]);
                }

                $data["result"] = true;
                $data["message"] = "選單建立成功";
            }
            
            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update($id, data_request $request)
    {
        try {
            $menu = [
                'id' => $id,
                'icon' => $request["icon"],
                'title' => $request["title"],
                'href' => $request["href"]
            ];

            $validator = Validator::make($menu, Menu::validate($menu["id"]));
            
            if ($validator->fails())
            {
                $error_msg = "";
                $error = $validator->errors();
                foreach ($error->all() as $message) {
                    $error_msg = $error_msg . $message;
                }

                $data['result'] = false;
                $data['message'] = $error_msg;
                
            } else {
                $updateMenu =  Menu::find($menu["id"]);

                $updateMenu -> icon = $menu["icon"];
                $updateMenu -> title = $menu["title"];
                $updateMenu -> href = $menu["href"];
                $updateMenu -> save();

                $data["result"] = true;
                $data["message"] = "選單修改成功";
            }
            
            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {
            $menus = Menu::where('parent',$id)->get();
            
            foreach ($menus as $menu) {
                MenuDetail::where('menu_id',$menu['id'])->delete();
            }

            MenuDetail::where('menu_id',$id)->delete();
            Menu::where('parent',$id)->delete();
            Menu::destroy($id);

            $data["result"] = true;
            $data["message"] = "選單刪除成功";

            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function destroyMany(data_request $request)
    {
        try {
            $ids = $request->json()->all();

            foreach ($ids as $id) {
                $menus = Menu::where('parent',$id)->get();

                foreach ($menus as $menu) {
                    MenuDetail::where('menu_id',$menu['id'])->delete();
                }

                MenuDetail::where('menu_id',$id)->delete();
                Menu::where('parent',$id)->delete();
                Menu::destroy($id);
            }

            $data["result"] = true;
            $data["message"] = "成功刪除".count($ids)."筆資料";
            
            return response()->json($data);
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    public function menu_list($user_id)
    {

        $role_menus = DB::select(
            DB::raw("select DISTINCT menu_id from menu_role 
            where role_id in (select role_id from role_user where user_id = '".$user_id."') order by menu_id")
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
