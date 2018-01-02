<?php

use Illuminate\Database\Seeder;

use App\Order;
use App\OrderDetail;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->delete();

        // Order::create([
        //     'payment_method' => '',
        //     'discount' => '',
        //     'total' => '',
        //     'remark' => '',
        //     'customer_id' => ''
        // ]);



        // DB::table('order_details')->delete();

        // Order::create([
        //     'order_id' => '',
        //     'product_id' => '',
        //     'name' => '',
        //     'price' => '',
        //     'num' => ''
        // ]);
    }
}
