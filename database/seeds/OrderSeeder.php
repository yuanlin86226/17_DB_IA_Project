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
            'total' => '1793',
            'remark' => 'BTS的要L、O版',
            'customer_id' => '1'
        ]);



        DB::table('order_details')->delete();

        OrderDetail::create([
            'order_id' => '1',
            'product_id' => '18',
            'name' => 'LOVE YOURSELF 承 Her',
            'price' => '498',
            'num' => '2'
        ]);
    }
}
