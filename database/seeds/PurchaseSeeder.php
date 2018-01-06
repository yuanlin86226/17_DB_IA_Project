<?php

use Illuminate\Database\Seeder;

use App\Purchase;
use App\PurchaseDetail;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchases')->delete();

        Purchase::create([
            'discount' => '0',
            'total' => '5850',
            'remark' => '承 Her專輯 L版3張、O版3張、V版2張、E版2張，
You Never Walk Alone專輯各5張，
WINGS專輯 W版2張、I版2張、N版3張、G版3張',
            'supplier_id' => '1'
        ]);
        Purchase::create([
            'discount' => '0',
            'total' => '6750',
            'remark' => 'Young Forever各5張',
            'supplier_id' => '1'
        ]);
        Purchase::create([
            'discount' => '0',
            'total' => '6030',
            'remark' => '',
            'supplier_id' => '1'
        ]);

        // Got7
        Purchase::create([
            'discount' => '0',
            'total' => '8100',
            'remark' => '10張附贈小卡',
            'supplier_id' => '4'
        ]);
        Purchase::create([
            'discount' => '1',
            'total' => '8400',
            'remark' => '10張附贈海報',
            'supplier_id' => '4'
        ]);
        Purchase::create([
            'discount' => '0',
            'total' => '6300',
            'remark' => '10張附贈海報',
            'supplier_id' => '4'
        ]);
        Purchase::create([
            'discount' => '0',
            'total' => '1800',
            'remark' => '10張附贈海報',
            'supplier_id' => '4'
        ]);
        // Twice
        Purchase::create([
            'discount' => '0',
            'total' => '9450',
            'remark' => '10張附贈簽名海報',
            'supplier_id' => '4'
        ]);
        Purchase::create([
            'discount' => '0',
            'total' => '6750',
            'remark' => '10張附贈隨機簽名小卡',
            'supplier_id' => '4'
        ]);
        // Day6
        Purchase::create([
            'discount' => '0',
            'total' => '8100',
            'remark' => '',
            'supplier_id' => '4'
        ]);

        // Bigbang
        Purchase::create([
            'discount' => '2',
            'total' => '10850',
            'remark' => '附贈10張隨機小卡及海報',
            'supplier_id' => '2'
        ]);

        // HightLight
        Purchase::create([
            'discount' => '0',
            'total' => '5400',
            'remark' => '附贈10張隨機小卡',
            'supplier_id' => '3'
        ]);

        // WannaOne
        Purchase::create([
            'discount' => '0',
            'total' => '4500',
            'remark' => '附贈10張隨機小卡及簽名海報',
            'supplier_id' => '5'
        ]);





        DB::table('purchase_details')->delete();

        PurchaseDetail::create([
            'purchase_id' => '1',
            'product_id' => '16',
            'name' => 'WINGS',
            'price' => '200',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '1',
            'product_id' => '17',
            'name' => 'You Never Walk Alone',
            'price' => '250',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '1',
            'product_id' => '18',
            'name' => 'LOVE YOURSELF 承 Her',
            'price' => '200',
            'num' => '10'
        ]);

        PurchaseDetail::create([
            'purchase_id' => '2',
            'product_id' => '15',
            'name' => 'Young Forever',
            'price' => '350',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '2',
            'product_id' => '14',
            'name' => '花樣年華 pt.2',
            'price' => '200',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '2',
            'product_id' => '13',
            'name' => '花樣年華 pt.1',
            'price' => '200',
            'num' => '10'
        ]);

        PurchaseDetail::create([
            'purchase_id' => '3',
            'product_id' => '12',
            'name' => 'Dark & Wild',
            'price' => '220',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '3',
            'product_id' => '11',
            'name' => 'Skool Luv Affair',
            'price' => '150',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '3',
            'product_id' => '10',
            'name' => 'O!RUL8,2?',
            'price' => '150',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '3',
            'product_id' => '9',
            'name' => '2 Cool 4 Skool',
            'price' => '150',
            'num' => '10'
        ]);


        //Got7
        PurchaseDetail::create([
            'purchase_id' => '4',
            'product_id' => '19',
            'name' => 'Got it?',
            'price' => '200',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '4',
            'product_id' => '20',
            'name' => 'GOT♡',
            'price' => '200',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '4',
            'product_id' => '21',
            'name' => 'Identify',
            'price' => '300',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '4',
            'product_id' => '22',
            'name' => 'Just Right',
            'price' => '200',
            'num' => '10'
        ]);

        PurchaseDetail::create([
            'purchase_id' => '5',
            'product_id' => '23',
            'name' => 'MAD',
            'price' => '200',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '5',
            'product_id' => '24',
            'name' => 'MAD Winter Edition',
            'price' => '850',
            'num' => '10'
        ]);

        PurchaseDetail::create([
            'purchase_id' => '6',
            'product_id' => '25',
            'name' => 'FLIGHT LOG:DEPARTURE',
            'price' => '200',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '6',
            'product_id' => '26',
            'name' => 'FLIGHT LOG:TURBULENCE',
            'price' => '200',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '6',
            'product_id' => '27',
            'name' => 'FLIGHT LOG:ARRIVAL',
            'price' => '300',
            'num' => '10'
        ]);

        PurchaseDetail::create([
            'purchase_id' => '7',
            'product_id' => '28',
            'name' => '7 FOR 7',
            'price' => '200',
            'num' => '10'
        ]);

        // Twice
        PurchaseDetail::create([
            'purchase_id' => '8',
            'product_id' => '33',
            'name' => 'The Story Begins',
            'price' => '200',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '8',
            'product_id' => '34',
            'name' => 'Page Two',
            'price' => '300',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '8',
            'product_id' => '35',
            'name' => 'TWICEcoaster:LANE 1',
            'price' => '300',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '8',
            'product_id' => '36',
            'name' => 'TWICEcoaster:LANE 2',
            'price' => '250',
            'num' => '10'
        ]);

        PurchaseDetail::create([
            'purchase_id' => '9',
            'product_id' => '37',
            'name' => 'SIGNAL',
            'price' => '250',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '9',
            'product_id' => '38',
            'name' => 'Twicetagram',
            'price' => '250',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '9',
            'product_id' => '39',
            'name' => 'Merry&Happy',
            'price' => '250',
            'num' => '10'
        ]);

        //Day6
        PurchaseDetail::create([
            'purchase_id' => '10',
            'product_id' => '29',
            'name' => 'The Day',
            'price' => '200',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '10',
            'product_id' => '30',
            'name' => 'DAYDREAM',
            'price' => '200',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '10',
            'product_id' => '31',
            'name' => 'SUNRISE',
            'price' => '250',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '10',
            'product_id' => '32',
            'name' => 'MOONRISE',
            'price' => '250',
            'num' => '10'
        ]);

        // Bigbang
        PurchaseDetail::create([
            'purchase_id' => '11',
            'product_id' => '1',
            'name' => 'BIGBANG MADE SERIES [M]',
            'price' => '200',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '11',
            'product_id' => '2',
            'name' => 'BIGBANG MADE SERIES [A]',
            'price' => '200',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '11',
            'product_id' => '3',
            'name' => 'BIGBANG MADE SERIES [D]',
            'price' => '200',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '11',
            'product_id' => '4',
            'name' => 'BIGBANG MADE SERIES [E]',
            'price' => '200',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '11',
            'product_id' => '5',
            'name' => 'BIGBANG MADE THE FULL ALBUM',
            'price' => '750',
            'num' => '10'
        ]);

        // HightLight
        PurchaseDetail::create([
            'purchase_id' => '12',
            'product_id' => '6',
            'name' => 'CAN YOU FEEL IT?',
            'price' => '200',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '12',
            'product_id' => '7',
            'name' => 'CALLING YOU',
            'price' => '200',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '12',
            'product_id' => '8',
            'name' => 'CELEBRATE',
            'price' => '200',
            'num' => '10'
        ]);


        // WannaOne
        PurchaseDetail::create([
            'purchase_id' => '13',
            'product_id' => '40',
            'name' => '1-1=0',
            'price' => '250',
            'num' => '10'
        ]);
        PurchaseDetail::create([
            'purchase_id' => '13',
            'product_id' => '41',
            'name' => '1X1=1',
            'price' => '250',
            'num' => '10'
        ]);
    }
}
