<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as data_request;

use App\User;

use App\Type;
use App\Product;
use App\OrderDetail;

use Exception;
use Validator;
use View;
use Auth;
use Redirect;
use Request;
use DB;

class ProductDataController extends Controller
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
                return View::make('admin/productData',['menu_id' => $menu_id]);
            }
            
        } else {
            return Redirect::action('AuthController@login');
        }
    }

    public function findAll()
    {
        $products = Product::with('type')->get();

        foreach ($products as $product) {
            $product['type_name'] = $product['type']['name'];
            unset($product['type']);
        }
        
        return response()->json($products);
    }

    public function findOne($id)
    {
        $product = Product::with('type')->find($id);

        $product['type_name'] = $product['type']['name'];
        unset($product['type']);

        return response()->json($product);
    }

    public function save(data_request $request)
    {
        try {
            $product = [
                'name' => $request["name"],
                'photo' => $request["photo"],
                'price' => $request["price"],
                'total_amount' => $request["total_amount"],
                'inventory' => $request["inventory"],
                'sales_amount' => $request["sales_amount"],
                'type_id' => $request["type_id"]
            ];

            $validator = Validator::make($product, Product::validate());
            
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
                $createdProduct = Product::create($product);

                $data["result"] = true;
                $data["message"] = "商品建立成功";
            }
            
            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update($id, data_request $request)
    {
        try {
            $product = [
                'id' => $id,
                'name' => $request["name"],
                'photo' => $request["photo"],
                'price' => $request["price"],
                'total_amount' => $request["total_amount"],
                'inventory' => $request["inventory"],
                'sales_amount' => $request["sales_amount"],
                'type_id' => $request["type_id"]
            ];

            // 資料驗證
            $validator = Validator::make($product, Product::validate($product["id"]));

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
                $updateProduct =  Product::find($product["id"]);
  
                $updateProduct -> name = $product["name"];
                $updateProduct -> photo = $product["photo"];
                $updateProduct -> price = $product["price"];
                $updateProduct -> total_amount = $product["total_amount"];
                $updateProduct -> inventory = $product["inventory"];
                $updateProduct -> sales_amount = $product["sales_amount"];
                $updateProduct -> type_id = $product["type_id"];
                $updateProduct -> save();

                $data["result"] = true;
                $data["message"] = "商品修改成功";
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
                DB::raw("update order_details set product_id = null where product_id = '".$id."'")
            );

            Product::destroy($id);

            $data["result"] = true;
            $data["message"] = "商品刪除成功";

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
                    DB::raw("update order_details set product_id = null where product_id = '".$id."'")
                );
                
                Product::destroy($id);
            }

            $data["result"] = true;
            $data["message"] = "成功刪除".count($ids)."筆資料";
            
            return response()->json($data);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
