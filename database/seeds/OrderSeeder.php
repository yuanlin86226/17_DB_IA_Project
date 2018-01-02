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

        Order::create([
            'payment_method' => '0',
            'discount' => '0',
            'total' => '',
            'remark' => '',
            'customer_id' => ''
        ]);



        // DB::table('order_details')->delete();

        OrderDetail::create([
            'order_id' => '1',
            'product_id' => '',
            'name' => '',
            'price' => '',
            'num' => ''
        ]);
    }
}
