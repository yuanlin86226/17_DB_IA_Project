<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as data_request;

use App\User;

use App\Supplier;
use App\Type;
use App\Product;
use App\Order;
use App\OrderDetail;
use App\Purchase;

use Exception;
use Validator;
use View;
use Auth;
use Redirect;
use Request;
use DB;

class SupplierController extends Controller
{
    public function index()
    {
        if (Auth::check()) {

            // menu_id要確認
            $menu_id = 9;
            $user_id = Auth::user()->id;

            $role_menus = User::able_page($user_id, $menu_id);

            if (count($role_menus)==0) {
                return Redirect::action('AuthController@login');
            } else {
                return View::make('admin/supplier',['menu_id' => $menu_id]);
            }
            
        } else {
            return Redirect::action('AuthController@login');
        }
    }

    public function findAll()
    {
        $suppliers = Supplier::all();
        return response()->json($suppliers);
    }

    public function findOne($id)
    {
        $supplier = Supplier::find($id);
        return response()->json($supplier);
    }

    public function save(data_request $request)
    {
        try {

            $supplier = [
                'name' => $request["name"],
                'tax' => $request["tax"],
                'website' => $request["website"],
                'email' => $request["email"],
                'fax' => $request["fax"],
                'telephone' => $request["telephone"],
                'address' => $request["address"],
                'ceo' => $request["ceo"]
            ];

            $validator = Validator::make($supplier, Supplier::validate());
            
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
                $createdSupplier = Supplier::create($supplier);

                $data["result"] = true;
                $data["message"] = "廠商建立成功";
            }
            
            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update($id, data_request $request)
    {
        try {
            $supplier = [
                'id' => $id,
                'name' => $request["name"],
                'tax' => $request["tax"],
                'website' => $request["website"],
                'email' => $request["email"],
                'fax' => $request["fax"],
                'telephone' => $request["telephone"],
                'address' => $request["address"],
                'ceo' => $request["ceo"]
            ];

            // 資料驗證
            $validator = Validator::make($supplier, Supplier::validate($supplier["id"]));

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
                $updateSupplier =  Supplier::find($supplier["id"]);
  
                $updateSupplier -> name = $supplier["name"];
                $updateSupplier -> tax = $supplier["tax"];
                $updateSupplier -> website = $supplier["website"];
                $updateSupplier -> email = $supplier["email"];
                $updateSupplier -> fax = $supplier["fax"];
                $updateSupplier -> telephone = $supplier["telephone"];
                $updateSupplier -> address = $supplier["address"];
                $updateSupplier -> ceo = $supplier["ceo"];
                $updateSupplier -> save();

                $data["result"] = true;
                $data["message"] = "廠商修改成功";
            }
        
            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {
            DB::select(
                DB::raw("update types set supplier_id = null where supplier_id = '".$id."'")
            );

            Supplier::destroy($id);

            $data["result"] = true;
            $data["message"] = "廠商刪除成功";

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
                DB::select(
                    DB::raw("update types set supplier_id = null where supplier_id = '".$id."'")
                );

                Supplier::destroy($id);
            }

            $data["result"] = true;
            $data["message"] = "成功刪除".count($ids)."筆資料";
            
            return response()->json($data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getPurchases($id)
    {
        $purchases = Purchase::where('supplier_id',$id)->get();

        return response()->json($purchases);
    }
}
