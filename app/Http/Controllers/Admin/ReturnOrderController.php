<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as data_request;

use App\User;

use App\Type;
use App\Product;
use App\Order;
use App\OrderDetail;

use Exception;
use Validator;
use View;
use Auth;
use Redirect;
use Request;
use DB;

class ReturnOrderController extends Controller
{
    public function index()
    {
        if (Auth::check()) {

            // menu_id要確認
            $menu_id = 18;
            $user_id = Auth::user()->id;

            $role_menus = User::able_page($user_id, $menu_id);

            if (count($role_menus)==0) {
                return Redirect::action('AuthController@login');
            } else {
                return View::make('admin/returnOrder',['menu_id' => $menu_id]);
            }
            
        } else {
            return Redirect::action('AuthController@login');
        }
    }

    public function findAll()
    {
        // $purchases = Purchase::with('supplier','details')->orderBy('created_at','desc')->get();
        $orders = Order::with('customer')->where('status',2)->orderBy('created_at','desc')->orderBy('id','desc')->get(); 

        foreach ($orders as $order) {
            $order['customer_name'] = $order['customer']['name'];
            unset($order['customer']);
        }   
        
        return response()->json($orders);
    }

    public function findOne($id)
    {
        $order = Order::with('customer','details')->find($id);
        $order['customer_name'] = $order['customer']['name'];

        if(isset($order['details'])){
            foreach ($order['details'] as $detail) {
                $product = Product::find($detail['product_id']);
                $detail['type_id'] = $product['type_id'];
            }
        }

        unset($order['customer']);

        return response()->json($order);
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
            $order = [
                'status' => 1,
                'discount' => $request["discount"],
                'total' => $request["total"],
                'remark' => $request["remark"],
                'customer_id' => $request["customer_id"]
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

            $validator = Validator::make($order, Order::validate());
            
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
                $createdOrder = Order::create($order);

                foreach ($details as $detail) {
                    $detail['order_id'] = $createdOrder -> id;

                    $validator2 = Validator::make($detail, OrderDetail::validate());

                    if ($validator2->fails()) {
                        $error_msg = "";
                        $error = $validator->errors();
                        foreach ($error->all() as $message) {
                            $error_msg = $error_msg . $message;
                        }

                        $data['result'] = false;
                        $data['message'] = $error_msg;
                    } else {
                        OrderDetail::create($detail);

                        $product = Product::find($detail['product_id']);
                        $product -> inventory -= $detail['num'];
                        $product -> sales_amount += $detail['num'];
                        $product -> save();
                    }

                }


                $data["result"] = true;
                $data["message"] = "訂單資料建立成功";
            }
            
            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update($id, data_request $request)
    {
        try {
            $order = [
                'id' => $id,
                'status' => $request["status"],
                'payment_method' => $request["payment_method"],
                'discount' => $request["discount"],
                'total' => $request["total"],
                'remark' => $request["remark"],
                'customer_id' => $request["customer_id"]
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
            $validator = Validator::make($order, Order::validate($order["id"]));

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
                $updateOrder = Order::find($order["id"]);
                $updateOrder -> status = $order["status"];
                $updateOrder -> payment_method = $order["payment_method"];
                $updateOrder -> discount = $order["discount"];
                $updateOrder -> total = $order["total"];
                $updateOrder -> remark = $order["remark"];
                $updateOrder -> customer_id = $order["customer_id"];
                $updateOrder -> save();

                $old_details = OrderDetail::where('order_id',$updateOrder->id)->get();

                foreach ($old_details as $old_detail) {
                    $product = Product::find($old_detail['product_id']);

                    $product -> inventory += $detail['num'];
                    $product -> sales_amount -= $detail['num'];

                    $product -> save();
                }

                OrderDetail::where('order_id',$order["id"])->delete();

                foreach ($details as $detail) {
                    $detail['order_id'] = $updateOrder -> id;

                    $validator2 = Validator::make($detail, OrderDetail::validate());

                    if ($validator2->fails()) {
                        $error_msg = "";
                        $error = $validator->errors();
                        foreach ($error->all() as $message) {
                            $error_msg = $error_msg . $message;
                        }

                        $data['result'] = false;
                        $data['message'] = $error_msg;
                    } else {
                        OrderDetail::create($detail);

                        if ($updateOrder->status == 0) {
                            $product = Product::find($detail['product_id']);
                            $product -> order_amount += $detail['num'];
                            $product -> save();

                        } elseif ($updateOrder->status == 1) {
                            $product = Product::find($detail['product_id']);
                            $product -> inventory -= $detail['num'];
                            $product -> sales_amount += $detail['num'];
                            $product -> save();
                        }
                        
                    }

                }


                $data["result"] = true;
                $data["message"] = "訂單資料修改成功";

            }
        
            return response()->json($data);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {

            $details = OrderDetail::where('order_id',$id)->get();

            foreach ($details as $detail) {
                $product = Product::find($detail['product_id']);

                $product -> inventory += $detail['num'];
                $product -> sales_amount -= $detail['num'];

                $product->save();

            }
            

            OrderDetail::where('order_id',$id)->delete();
            Order::destroy($id);

            $data["result"] = true;
            $data["message"] = "訂單資料刪除成功";

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
                $details = OrderDetail::where('order_id',$id)->get();

                foreach ($details as $detail) {
                    $product = Product::find($detail['product_id']);

                    $product -> inventory += $detail['num'];
                    $product -> sales_amount -= $detail['num'];

                    $product->save();

                }
                

                OrderDetail::where('order_id',$id)->delete();
                Order::destroy($id);
            }

            $data["result"] = true;
            $data["message"] = "成功刪除".count($ids)."筆資料";
            
            return response()->json($data);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
