<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UtilController;
use Illuminate\Http\Request as data_request;

use App\User;
use App\Role;
use App\RoleUser;
use App\MenuRole;
use App\MenuDetail;

use DB;
use Exception;
use View;
use Auth;
use Redirect;
use Response;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::check()) {

            // menu_id要確認
            $menu_id = 2;
            $user_id = Auth::user()->id;

            $role_menus = DB::select(
                DB::raw("select DISTINCT menu_id from menu_role 
                where role_id in (select role_id from role_user where user_id = '".$user_id."') and menu_id = '".$menu_id."'")
            );

            if (count($role_menus)==0) {
                return Redirect::action('AuthController@login');
            } else {
                return View::make('admin/user',['menu_id' => $menu_id]);
            }

            
            return View::make('admin/user',['menu_id' => $menu_id]);
        } else {
            return Redirect::action('AuthController@login');
        }
    }

    // 之後要移到RoleController底下，全部共用
    public function getSign($id,$menu_id)
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

    public function findOne($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function getRoles ($id)
    {
        $roles = array();
        $roles_id = RoleUser::where('user_id',$id)->get();

        for( $i=0; $i<count($roles_id); $i++) {
            $roles[$i] = Role::find($roles_id[$i]['role_id'])->name;
        }

        return response()->json($roles);
    }

    public function save(data_request $request)
    {
        try {
            // user資料
            $user = [
                'userName' => $request["userName"],
                'password' => bcrypt($request["password"]),
                'name' => $request["name"],
                'email' => $request["email"],
                'phoneNumber' => $request["phoneNumber"],
                'remark' => $request["remark"],
                'remember_token' => str_random(10),
                'roles' => $request["roles"],
            ];

            // 資料驗證
            $validator = Validator::make($user, User::validate());
            
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
                $createdUser = User::create($user);

                for( $i=0; $i<count($user["roles"]); $i++ ) {
                    $role = Role::where('name', $user["roles"][$i])->first();
                    $createdUser->roles()->attach($role);
                }

                $data["result"] = true;
                $data["message"] = "使用者建立成功";
            }
            
            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update($id, data_request $request)
    {
        try {
            // user資料
            $user = [
                'id' => $id,
                'userName' => $request["userName"],
                'password' => $request["password"],
                'name' => $request["name"],
                'email' => $request["email"],
                'phoneNumber' => $request["phoneNumber"],
                'remark' => $request["remark"],
                'roles' => $request["roles"],
            ];

            // 資料驗證
            $validator = Validator::make($user, User::validate($user["id"]));

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
                $updateUser =  User::find($user["id"]);

                if ($user["password"]!="") {$updateUser -> password = bcrypt($user["password"]);}   
                $updateUser -> userName = $user["userName"];
                $updateUser -> name = $user["name"];
                $updateUser -> email = $user["email"];
                $updateUser -> phoneNumber = $user["phoneNumber"];
                $updateUser -> remark = $user["remark"];
                $updateUser -> save();

                if (isset($user["roles"])) {
                    RoleUser::where('user_id',$updateUser->id)->delete();
                    
                    for( $i=0; $i<count($user["roles"]); $i++ ) {
                        $role = Role::where('name', $user['roles'][$i])->first();
                        $updateUser->roles()->attach($role);
                    }
                }

                $data["result"] = true;
                $data["message"] = "使用者修改成功";
            }
        
            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {

            RoleUser::where('user_id',$id)->delete();
            User::destroy($id);

            $data["result"] = true;
            $data["message"] = "使用者刪除成功";

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
                RoleUser::where('user_id',$id)->delete();
                User::destroy($id);
            }

            $data["result"] = true;
            $data["message"] = "成功刪除".count($ids)."筆資料";
            
            return response()->json($data);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
