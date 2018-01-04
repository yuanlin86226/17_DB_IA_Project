<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as data_request;

use App\User;

use App\Type;
use App\Supplier;
use App\Product;
use App\OrderDetail;

use Exception;
use Validator;
use View;
use Auth;
use Redirect;
use Request;
use DB;

class ProductTypeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {

            // menu_id要確認
            $menu_id = 10;
            $user_id = Auth::user()->id;

            $role_menus = User::able_page($user_id, $menu_id);

            if (count($role_menus)==0) {
                return Redirect::action('AuthController@login');
            } else {
                return View::make('admin/productType',['menu_id' => $menu_id]);
            }
            
        } else {
            return Redirect::action('AuthController@login');
        }
    }

    public function findAll()
    {
        $types = Type::all();
        return response()->json($types);
    }

    public function findOne($id)
    {
        $type = Type::find($id);
        $supplier = Supplier::find($type['supplier_id']);
        $type['supplier'] = $supplier['name'];

        return response()->json($type);
    }

    public function save(data_request $request)
    {
        try {
            $type = [
                'name' => $request["name"],
                'folder' => $request["folder"],
                'discription' => $request["discription"],
                'supplier_id' => $request["supplier_id"]
            ];

            $validator = Validator::make($type, Type::validate());
            
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
                $createdType = Type::create($type);

                $data["result"] = true;
                $data["message"] = "分類建立成功";
            }
            
            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update($id, data_request $request)
    {
        try {
            $type = [
                'id' => $id,
                'name' => $request["name"],
                'folder' => $request["folder"],
                'discription' => $request["discription"],
                'supplier_id' => $request["supplier_id"]
            ];

            // 資料驗證
            $validator = Validator::make($type, Type::validate($type["id"]));

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
                $updateType =  Type::find($type["id"]);
  
                $updateType -> name = $type["name"];
                $updateType -> folder = $type["folder"];
                $updateType -> discription = $type["discription"];
                $updateType -> supplier_id = $type["supplier_id"];
                $updateType -> save();

                $data["result"] = true;
                $data["message"] = "分類修改成功";
            }
        
            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {
            
            $products = Product::where('type_id',$id)->get();

            foreach ($products as $product) {
                DB::select(
                    DB::raw("update order_details set product_id = null where product_id = '".$product['id']."'")
                );
            }
            

            Product::where('type_id',$id)->delete();
            Type::destroy($id);

            $data["result"] = true;
            $data["message"] = "分類刪除成功";

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
                $products = Product::where('type_id',$id)->get();

                foreach ($products as $product) {
                    DB::select(
                        DB::raw("update order_details set product_id = null where product_id = '".$product['id']."'")
                    );
                }
                Product::where('type_id',$id)->delete();
                Type::destroy($id);
            }

            $data["result"] = true;
            $data["message"] = "成功刪除".count($ids)."筆資料";
            
            return response()->json($data);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
