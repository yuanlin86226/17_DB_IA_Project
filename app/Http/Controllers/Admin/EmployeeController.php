<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as data_request;

use App\User;

use App\Employee;

use Exception;
use Validator;
use View;
use Auth;
use Redirect;
use Request;
use DB;

class EmployeeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {

            // menu_id要確認
            $menu_id = 7;
            $user_id = Auth::user()->id;

            $role_menus = User::able_page($user_id, $menu_id);

            if (count($role_menus)==0) {
                return Redirect::action('AuthController@login');
            } else {
                return View::make('admin/employee',['menu_id' => $menu_id]);
            }
            
        } else {
            return Redirect::action('AuthController@login');
        }
    }

    public function findAll()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    public function findOne($id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
    }

    public function save(data_request $request)
    {
        try {
            $employee = [
                'job' => $request["job"],
                'name' => $request["name"],
                'identity_id' => $request["identity_id"],
                'sex' => $request["sex"],
                'birthday' => $request["birthday"],
                'email' => $request["email"],
                'cellphone' => $request["cellphone"],
                'address' => $request["address"],
                'start_date' => $request["start_date"],
                'status' => $request["status"],
                'end_date' => $request["end_date"]
            ];

            $validator = Validator::make($employee, Employee::validate());
            
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
                $createdEmployee = Employee::create($employee);

                $data["result"] = true;
                $data["message"] = "員工建立成功";
            }
            
            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update($id, data_request $request)
    {
        try {
            $employee = [
                'id' => $id,
                'job' => $request["job"],
                'name' => $request["name"],
                'identity_id' => $request["identity_id"],
                'sex' => $request["sex"],
                'birthday' => $request["birthday"],
                'email' => $request["email"],
                'cellphone' => $request["cellphone"],
                'address' => $request["address"],
                'start_date' => $request["start_date"],
                'status' => $request["status"],
                'end_date' => $request["end_date"]
            ];

            // 資料驗證
            $validator = Validator::make($employee, Employee::validate($employee["id"]));

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
                $updateEmployee =  Employee::find($employee["id"]);
  
                $updateEmployee -> job = $employee["job"];
                $updateEmployee -> name = $employee["name"];
                $updateEmployee -> identity_id = $employee["identity_id"];
                $updateEmployee -> sex = $employee["sex"];
                $updateEmployee -> birthday = $employee["birthday"];
                $updateEmployee -> email = $employee["email"];
                $updateEmployee -> cellphone = $employee["cellphone"];
                $updateEmployee -> address = $employee["address"];
                $updateEmployee -> start_date = $employee["start_date"];
                $updateEmployee -> status = $employee["status"];
                $updateEmployee -> end_date = $employee["end_date"];
                $updateEmployee -> save();

                $data["result"] = true;
                $data["message"] = "員工修改成功";
            }
        
            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {

            Employee::destroy($id);

            $data["result"] = true;
            $data["message"] = "員工刪除成功";

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
                Employee::destroy($id);
            }

            $data["result"] = true;
            $data["message"] = "成功刪除".count($ids)."筆資料";
            
            return response()->json($data);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
