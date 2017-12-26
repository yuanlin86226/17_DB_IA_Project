<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as data_request;

use App\User;
use App\RoleUser;
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

    public function save(data_request $request)
    {
        try {
            $role = [
                'name' => $request["name"],
                'description' => $request["description"]
            ];

            $menu_details = array();

            foreach ($request["menu"] as $menus) {
                foreach ($menus as $menu) {
                    $menu_details[count($menu_details)] = $menu;
                }
            }

            $validator = Validator::make($role, Role::validate());
            
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
                $createdRole = Role::create($role);

                if($createdRole) {
                    foreach ($menu_details as $md) {
                        
                        $count_num = 0;

                        if($md['view']=='true'){
                            $detail = MenuDetail::where('menu_id',$md['id'])->where('sign','view')->get();
                            
                            MenuRole::create([
                                'menu_id' => $md['id'],
                                'menu_detail_id' => $detail[0]->id,
                                'role_id' => $createdRole->id
                            ]);

                            $count_num++;
                        }

                        if($md['insert']=='true'){
                            $detail = MenuDetail::where('menu_id',$md['id'])->where('sign','insert')->get();
                            
                            MenuRole::create([
                                'menu_id' => $md['id'],
                                'menu_detail_id' => $detail[0]->id,
                                'role_id' => $createdRole->id
                            ]);

                            $count_num++;
                        }

                        if($md['edit']=='true'){
                            $detail = MenuDetail::where('menu_id',$md['id'])->where('sign','edit')->get();
                            
                            MenuRole::create([
                                'menu_id' => $md['id'],
                                'menu_detail_id' => $detail[0]->id,
                                'role_id' => $createdRole->id
                            ]);

                            $count_num++;
                        }

                        if($md['delete']=='true'){
                            $detail = MenuDetail::where('menu_id',$md['id'])->where('sign','delete')->get();
                            
                            MenuRole::create([
                                'menu_id' => $md['id'],
                                'menu_detail_id' => $detail[0]->id,
                                'role_id' => $createdRole->id
                            ]);

                            $count_num++;
                        }
                        
                        if($count_num!=0) {
                            $parent = DB::select(
                                DB::raw("select id from menus 
                                    where id = (select parent from menus where id = '".$md['id']."')")
                            );
                            
                            $parent_exist = MenuRole::where('role_id',$createdRole->id)->where('menu_id',$parent[0]->id)->get();
                            
                            if(count($parent_exist)==0){
                                MenuRole::create([
                                    'menu_id' => $parent[0]->id,
                                    'menu_detail_id' => null,
                                    'role_id' => $createdRole->id
                                ]);
                            }
                        }
                    }
                }

                $data["result"] = true;
                $data["message"] = "群組建立成功";
            }
            
            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update($id, data_request $request)
    {
        try {
            $role = [
                'id' => $id,
                'name' => $request["name"],
                'description' => $request["description"]
            ];

            $menu_details = array();

            foreach ($request["menu"] as $menus) {
                foreach ($menus as $menu) {
                    $menu_details[count($menu_details)] = $menu;
                }
            }

            // 資料驗證
            $validator = Validator::make($role, Role::validate($role["id"]));

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
                // 修改資料
                $updateRole =  Role::find($role["id"]);
  
                $updateRole -> name = $role["name"];
                $updateRole -> description = $role["description"];
                $updateRole -> save();

                if($updateRole) {
                    foreach ($menu_details as $md) {

                        $count_num = 0;

                        MenuRole::where('role_id',$role['id'])->where('menu_id',$md['id'])->delete();
                        
                        if($md['view']=='true'){
                            $detail = MenuDetail::where('menu_id',$md['id'])->where('sign','view')->get();
                            
                            MenuRole::create([
                                'menu_id' => $md['id'],
                                'menu_detail_id' => $detail[0]->id,
                                'role_id' => $id
                            ]);

                            $count_num++;
                        }

                        if($md['insert']=='true'){
                            $detail = MenuDetail::where('menu_id',$md['id'])->where('sign','insert')->get();
                            
                            MenuRole::create([
                                'menu_id' => $md['id'],
                                'menu_detail_id' => $detail[0]->id,
                                'role_id' => $id
                            ]);

                            $count_num++;
                        }

                        if($md['edit']=='true'){
                            $detail = MenuDetail::where('menu_id',$md['id'])->where('sign','edit')->get();
                            
                            MenuRole::create([
                                'menu_id' => $md['id'],
                                'menu_detail_id' => $detail[0]->id,
                                'role_id' => $id
                            ]);

                            $count_num++;
                        }

                        if($md['delete']=='true'){
                            $detail = MenuDetail::where('menu_id',$md['id'])->where('sign','delete')->get();
                            
                            MenuRole::create([
                                'menu_id' => $md['id'],
                                'menu_detail_id' => $detail[0]->id,
                                'role_id' => $id
                            ]);

                            $count_num++;
                        }

                        if($count_num!=0) {
                            $parent = DB::select(
                                DB::raw("select id from menus 
                                    where id = (select parent from menus where id = '".$md['id']."')")
                            );

                            $parent_exist = MenuRole::where('role_id',$id)->where('menu_id',$parent[0]->id)->get();

                            if(count($parent_exist)==0){
                                MenuRole::create([
                                    'menu_id' => $parent[0]->id,
                                    'menu_detail_id' => null,
                                    'role_id' => $id
                                ]);
                            }
                        }
                    }
                }

                $role_parents = MenuRole::where('role_id',$id)->where('menu_detail_id',null)->get();
                
                foreach($role_parents as $role_parent) {
                    $count_child = DB::select(
                        DB::raw("select id from menu_role 
                            where menu_id in (select id from menus where parent = '".$role_parent['menu_id']."')
                            and role_id = '".$id."'")
                    );
                    
                    if(count($count_child)==0){
                        MenuRole::where('menu_id',$role_parent['menu_id'])->where('role_id',$id)->delete();
                    }
                }

                $data["result"] = true;
                $data["message"] = "群組修改成功";
            }
        
            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {
            RoleUser::where('role_id',$id)->delete();
            MenuRole::where('role_id',$id)->delete();
            Role::destroy($id);

            $data["result"] = true;
            $data["message"] = "角色刪除成功";

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
                RoleUser::where('role_id',$id)->delete();
                MenuRole::where('role_id',$id)->delete();
                Role::destroy($id);
            }

            $data["result"] = true;
            $data["message"] = "成功刪除".count($ids)."筆資料";
            
            return response()->json($data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function findOneMenuDetail($id, $menu_id)
    {
        $data = array();
        $menus = Menu::where('parent',$menu_id)->get();

        foreach ($menus as $index => $menu) {
            $data[$index] = [
                'id' => $menu['id'],
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
