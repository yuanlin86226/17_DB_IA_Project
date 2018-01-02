<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as data_request;

use App\User;

use App\Customer;

use Exception;
use Validator;
use View;
use Auth;
use Redirect;
use Request;
use DB;

class CustomerController extends Controller
{
    public function index()
    {
        if (Auth::check()) {

            // menu_id要確認
            $menu_id = 8;
            $user_id = Auth::user()->id;

            $role_menus = User::able_page($user_id, $menu_id);

            if (count($role_menus)==0) {
                return Redirect::action('AuthController@login');
            } else {
                return View::make('admin/customer',['menu_id' => $menu_id]);
            }
            
        } else {
            return Redirect::action('AuthController@login');
        }
    }

    public function findAll()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    public function findOne($id)
    {
        $customer = Customer::find($id);
        return response()->json($customer);
    }

    public function save(data_request $request)
    {
        try {
            $customer = [
                'name' => $request["name"],
                'sex' => $request["sex"],
                'birthday' => $request["birthday"],
                'email' => $request["email"],
                'cellphone' => $request["cellphone"],
                'address' => $request["address"]
            ];

            $validator = Validator::make($customer, Customer::validate());
            
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
                $createdCustomer = Customer::create($customer);

                $data["result"] = true;
                $data["message"] = "客戶建立成功";
            }
            
            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update($id, data_request $request)
    {
        try {
            $customer = [
                'id' => $id,
                'name' => $request["name"],
                'sex' => $request["sex"],
                'birthday' => $request["birthday"],
                'email' => $request["email"],
                'cellphone' => $request["cellphone"],
                'address' => $request["address"]
            ];

            // 資料驗證
            $validator = Validator::make($customer, Customer::validate($customer["id"]));

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
                $updateCustomer =  Customer::find($customer["id"]);
  
                $updateCustomer -> name = $customer["name"];
                $updateCustomer -> sex = $customer["sex"];
                $updateCustomer -> birthday = $customer["birthday"];
                $updateCustomer -> email = $customer["email"];
                $updateCustomer -> cellphone = $customer["cellphone"];
                $updateCustomer -> address = $customer["address"];

                $updateCustomer -> save();

                $data["result"] = true;
                $data["message"] = "客戶修改成功";
            }
        
            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {

            Customer::destroy($id);

            $data["result"] = true;
            $data["message"] = "客戶刪除成功";

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
                Customer::destroy($id);
            }

            $data["result"] = true;
            $data["message"] = "成功刪除".count($ids)."筆資料";
            
            return response()->json($data);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
