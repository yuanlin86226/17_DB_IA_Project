<?php

use Illuminate\Database\Seeder;

use App\ReturnPurchase;
use App\ReturnPurchaseDetail;

class ReturnPurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('return_purchases')->delete();

        ReturnPurchase::create([
            'status' => '0',
            'total' => '2000',
            'remark' => '退款金額以總額打9折去零頭結算',
            'supplier_id' => '1'
        ]);

        ReturnPurchase::create([
            'status' => '0',
            'total' => '6300',
            'remark' => '退款金額以總額打9折',
            'supplier_id' => '4'
        ]);

        ReturnPurchase::create([
            'status' => '1',
            'total' => '0',
            'remark' => '直接換貨，無需退款',
            'supplier_id' => '4'
        ]);




        DB::table('return_purchase_details')->delete();

        ReturnPurchaseDetail::create([
            'return_purchase_id' => '1',
            'product_id' => '17',
            'name' => 'You Never Walk Alone',
            'price' => '250',
            'num' => '5'
        ]);
        ReturnPurchaseDetail::create([
            'return_purchase_id' => '1',
            'product_id' => '18',
            'name' => 'LOVE YOURSELF 承 Her',
            'price' => '200',
            'num' => '5'
        ]);

        ReturnPurchaseDetail::create([
            'return_purchase_id' => '2',
            'product_id' => '25',
            'name' => 'FLIGHT LOG:DEPARTURE',
            'price' => '200',
            'num' => '10'
        ]);
        ReturnPurchaseDetail::create([
            'return_purchase_id' => '2',
            'product_id' => '26',
            'name' => 'FLIGHT LOG:TURBULENCE',
            'price' => '200',
            'num' => '10'
        ]);
        ReturnPurchaseDetail::create([
            'return_purchase_id' => '2',
            'product_id' => '27',
            'name' => 'FLIGHT LOG:ARRIVAL',
            'price' => '300',
            'num' => '10'
        ]);

        ReturnPurchaseDetail::create([
            'return_purchase_id' => '3',
            'product_id' => '37',
            'name' => 'SIGNAL',
            'price' => '0',
            'num' => '5'
        ]);
        ReturnPurchaseDetail::create([
            'return_purchase_id' => '3',
            'product_id' => '39',
            'name' => 'Merry&Happy',
            'price' => '0',
            'num' => '5'
        ]);
    }
}
