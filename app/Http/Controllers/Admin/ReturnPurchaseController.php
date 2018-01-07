<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as data_request;

use App\User;

use App\Type;
use App\Product;
use App\Purchase;
use App\PurchaseDetail;
use App\ReturnPurchase;
use App\ReturnPurchaseDetail;

use Exception;
use Validator;
use View;
use Auth;
use Redirect;
use Request;
use DB;

class ReturnPurchaseController extends Controller
{
    public function index()
    {
        if (Auth::check()) {

            // menu_id要確認
            $menu_id = 14;
            $user_id = Auth::user()->id;

            $role_menus = User::able_page($user_id, $menu_id);

            if (count($role_menus)==0) {
                return Redirect::action('AuthController@login');
            } else {
                return View::make('admin/returnPurchase',['menu_id' => $menu_id]);
            }
            
        } else {
            return Redirect::action('AuthController@login');
        }
    }

    public function findAll()
    {
        // $purchases = Purchase::with('supplier','details')->orderBy('created_at','desc')->get();
        $purchases = ReturnPurchase::with('supplier')->orderBy('created_at','desc')->orderBy('id','desc')->get(); 
        foreach ($purchases as $purchase) {
            $purchase['supplier_name'] = $purchase['supplier']['name'];
            unset($purchase['supplier']);
        }   
        
        return response()->json($purchases);
    }

    public function findOne($id)
    {
        $purchase = ReturnPurchase::with('supplier','details')->find($id);
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
                'status' => $request["status"],
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

            $validator = Validator::make($purchase, ReturnPurchase::validate());
            
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
                $createdPurchase = ReturnPurchase::create($purchase);

                foreach ($details as $detail) {
                    $detail['return_purchase_id'] = $createdPurchase -> id;

                    $validator2 = Validator::make($detail, ReturnPurchaseDetail::validate());

                    if ($validator2->fails()) {
                        $error_msg = "";
                        $error = $validator->errors();
                        foreach ($error->all() as $message) {
                            $error_msg = $error_msg . $message;
                        }

                        $data['result'] = false;
                        $data['message'] = $error_msg;
                    } else {
                        ReturnPurchaseDetail::create($detail);

                        if ($purchase['status'] == 0) {
                            $product = Product::find($detail['product_id']);
                            $product -> total_amount -= $detail['num'];
                            $product -> inventory -= $detail['num'];
                            $product -> save();
                        }
                        
                    }

                }


                $data["result"] = true;
                $data["message"] = "退貨資料建立成功";
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
                'status' => $request["status"],
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
            $validator = Validator::make($purchase, ReturnPurchase::validate($purchase["id"]));

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
                $updatePurchase = ReturnPurchase::find($purchase["id"]);

                if($updatePurchase["status"] == 0) {
                    $old_details = ReturnPurchaseDetail::where('return_purchase_id',$purchase["id"])->get();
                    
                    foreach ($old_details as $old_detail) {
                        $product = Product::find($old_detail['product_id']);
                        $product -> total_amount += $old_detail['num'];
                        $product -> inventory += $old_detail['num'];
                        $product -> save();
                    }
                }

                $updatePurchase -> status = $purchase["status"];
                $updatePurchase -> total = $purchase["total"];
                $updatePurchase -> remark = $purchase["remark"];
                $updatePurchase -> supplier_id = $purchase["supplier_id"];
                $updatePurchase -> save();


                ReturnPurchaseDetail::where('return_purchase_id',$purchase["id"])->delete();

                foreach ($details as $detail) {
                    $detail['return_purchase_id'] = $purchase["id"];

                    $validator2 = Validator::make($detail, ReturnPurchaseDetail::validate());

                    if ($validator2->fails()) {
                        $error_msg = "";
                        $error = $validator->errors();
                        foreach ($error->all() as $message) {
                            $error_msg = $error_msg . $message;
                        }

                        $data['result'] = false;
                        $data['message'] = $error_msg;
                    } else {
                        ReturnPurchaseDetail::create($detail);

                        if ($updatePurchase["status"] == 0) {
                            $product = Product::find($detail['product_id']);
                            $product -> total_amount -= $detail['num'];
                            $product -> inventory -= $detail['num'];
                            $product -> save();
                        }
                        
                    }

                }


                $data["result"] = true;
                $data["message"] = "退貨資料修改成功";

            }
        
            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {
            $purchase = ReturnPurchase::find($id);

            if ($purchase->status == 0) {
                $details = ReturnPurchaseDetail::where('return_purchase_id',$id)->get();

                foreach ($details as $detail) {
                    $product = Product::find($detail['product_id']);

                    $product->total_amount += $detail['num'];
                    $product->inventory += $detail['num'];

                    $product->save();
                }
            }   

            ReturnPurchaseDetail::where('return_purchase_id',$id)->delete();
            ReturnPurchase::destroy($id);

            $data["result"] = true;
            $data["message"] = "退貨資料刪除成功";

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
                $purchase = ReturnPurchase::find($id);

                if ($purchase->status == 0) {
                    $details = ReturnPurchaseDetail::where('return_purchase_id',$id)->get();

                    foreach ($details as $detail) {
                        $product = Product::find($detail['product_id']);

                        $product->total_amount += $detail['num'];
                        $product->inventory += $detail['num'];

                        $product->save();
                    }
                }   

                ReturnPurchaseDetail::where('return_purchase_id',$id)->delete();
                ReturnPurchase::destroy($id);
            }

            $data["result"] = true;
            $data["message"] = "成功刪除".count($ids)."筆資料";
            
            return response()->json($data);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
