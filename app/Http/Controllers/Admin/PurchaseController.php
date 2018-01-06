<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as data_request;

use App\User;

use App\Type;
// use App\Supplier;
use App\Product;
// use App\OrderDetail;
use App\Purchase;
use App\PurchaseDetail;

use Exception;
use Validator;
use View;
use Auth;
use Redirect;
use Request;
use DB;

class PurchaseController extends Controller
{
    public function index()
    {
        if (Auth::check()) {

            // menu_id要確認
            $menu_id = 13;
            $user_id = Auth::user()->id;

            $role_menus = User::able_page($user_id, $menu_id);

            if (count($role_menus)==0) {
                return Redirect::action('AuthController@login');
            } else {
                return View::make('admin/purchase',['menu_id' => $menu_id]);
            }
            
        } else {
            return Redirect::action('AuthController@login');
        }
    }

    public function findAll()
    {
        // $purchases = Purchase::with('supplier','details')->orderBy('created_at','desc')->get();
        $purchases = Purchase::with('supplier')->orderBy('created_at','desc')->orderBy('id','desc')->get(); 
        foreach ($purchases as $purchase) {
            $purchase['supplier_name'] = $purchase['supplier']['name'];
            unset($purchase['supplier']);
        }   
        
        return response()->json($purchases);
    }

    public function findOne($id)
    {
        $purchase = Purchase::with('supplier','details')->find($id);
        $purchase['supplier_name'] = $purchase['supplier']['name'];

        if(isset($purchase['details'])){
            foreach ($purchase['details'] as $detail) {
                $product = Product::find($detail['product_id']);
                $detail['type_id'] = $product['type_id'];
            }
        }

        unset($purchase['supplier']);

        return response()->json($purchase);
    }

    public function findType($id)
    {
        // $prouducts = Type::where('supplier_id',$id)->with('product')->get();     
        $types = Type::where('supplier_id',$id)->get();

        return response()->json($types);
    }

    public function findProduct($id)
    {   
        $prouducts = Product::where('type_id',$id)->get();

        return response()->json($prouducts);
    }

    public function findData($id)
    {    
        $prouduct = Product::find($id);

        return response()->json($prouduct);
    }

    public function save(data_request $request)
    {
        try {
            $purchase = [
                'discount' => $request["discount"],
                'total' => $request["total"],
                'remark' => $request["remark"],
                'supplier_id' => $request["supplier_id"]
            ];

            $details = array();
            foreach ($request['form_datas'] as $index => $detail) {
                $details[$index] = [
                    'product_id' => $detail['product_id'],
                    'name' => $detail['name'],
                    'price' => $detail['price'],
                    'num' => $detail['num']
                ];
            }

            $validator = Validator::make($purchase, Purchase::validate());
            
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
                $createdPurchase = Purchase::create($purchase);

                foreach ($details as $detail) {
                    $detail['purchase_id'] = $createdPurchase -> id;

                    $validator2 = Validator::make($detail, PurchaseDetail::validate());

                    if ($validator2->fails()) {
                        $error_msg = "";
                        $error = $validator->errors();
                        foreach ($error->all() as $message) {
                            $error_msg = $error_msg . $message;
                        }

                        $data['result'] = false;
                        $data['message'] = $error_msg;
                    } else {
                        PurchaseDetail::create($detail);

                        $product = Product::find($detail['product_id']);
                        $product -> total_amount += $detail['num'];
                        $product -> inventory += $detail['num'];
                        $product -> save();
                    }

                }


                $data["result"] = true;
                $data["message"] = "進貨資料建立成功";
            }
            
            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update($id, data_request $request)
    {
        try {
            $purchase = [
                'id' => $id,
                'discount' => $request["discount"],
                'total' => $request["total"],
                'remark' => $request["remark"],
                'supplier_id' => $request["supplier_id"]
            ];

            $details = array();
            foreach ($request['form_datas'] as $index => $detail) {
                $details[$index] = [
                    'product_id' => $detail['product_id'],
                    'name' => $detail['name'],
                    'price' => $detail['price'],
                    'num' => $detail['num']
                ];
            }

            // 資料驗證
            $validator = Validator::make($purchase, Purchase::validate($purchase["id"]));

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
                $updatePurchase = Purchase::find($purchase["id"]);
                $updatePurchase -> discount = $purchase["discount"];
                $updatePurchase -> total = $purchase["total"];
                $updatePurchase -> remark = $purchase["remark"];
                $updatePurchase -> supplier_id = $purchase["supplier_id"];
                $updatePurchase -> save();

                $old_details = PurchaseDetail::where('purchase_id',$purchase["id"])->get();

                foreach ($old_details as $old_detail) {
                    $product = Product::find($old_detail['product_id']);
                    $product -> total_amount -= $old_detail['num'];
                    $product -> inventory -= $old_detail['num'];
                    $product -> save();
                }

                PurchaseDetail::where('purchase_id',$purchase["id"])->delete();

                foreach ($details as $detail) {
                    $detail['purchase_id'] = $updatePurchase -> id;

                    $validator2 = Validator::make($detail, PurchaseDetail::validate());

                    if ($validator2->fails()) {
                        $error_msg = "";
                        $error = $validator->errors();
                        foreach ($error->all() as $message) {
                            $error_msg = $error_msg . $message;
                        }

                        $data['result'] = false;
                        $data['message'] = $error_msg;
                    } else {
                        PurchaseDetail::create($detail);

                        $product = Product::find($detail['product_id']);
                        $product -> total_amount += $detail['num'];
                        $product -> inventory += $detail['num'];
                        $product -> save();
                    }

                }


                $data["result"] = true;
                $data["message"] = "進貨資料修改成功";

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
