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

        // BTS
        Order::create([
            'payment_method' => '0',
            'discount' => '1',
            'total' => '2136',
            'remark' => '承 Her要L版，
            You Never Walk Alone各1張，
            WINGS要I、N版',
            'customer_id' => '1'
        ]);
        Order::create([
            'payment_method' => '0',
            'discount' => '1',
            'total' => '3802',
            'remark' => 'Young Forever黑夜版1張',
            'customer_id' => '1'
        ]);
        Order::create([
            'payment_method' => '1',
            'discount' => '2',
            'total' => '5434',
            'remark' => '附贈限量立牌組',
            'customer_id' => '1'
        ]);

        // Got7
        Order::create([
            'payment_method' => '1',
            'discount' => '0',
            'total' => '6808',
            'remark' => '附贈小卡',
            'customer_id' => '2'
        ]);
        Order::create([
            'payment_method' => '1',
            'discount' => '0',
            'total' => '3689',
            'remark' => '附贈新版人形立牌',
            'customer_id' => '2'
        ]);
        Order::create([
            'payment_method' => '0',
            'discount' => null,
            'total' => '2738',
            'remark' => '附贈限量簽名海報',
            'customer_id' => '2'
        ]);

        // Twice
        Order::create([
            'payment_method' => '1',
            'discount' => '1',
            'total' => '7808',
            'remark' => '附贈小卡',
            'customer_id' => '5'
        ]);
        Order::create([
            'payment_method' => '1',
            'discount' => '0',
            'total' => '6678',
            'remark' => '附贈海報',
            'customer_id' => '5'
        ]);

        // Day6
        Order::create([
            'payment_method' => '1',
            'discount' => '0',
            'total' => '8343',
            'remark' => '附贈海報',
            'customer_id' => '4'
        ]);

        // Bigbang
        Order::create([
            'payment_method' => '1',
            'discount' => '2',
            'total' => '6943',
            'remark' => '附贈海報及小卡',
            'customer_id' => '6'
        ]);

        // HighLight
        Order::create([
            'payment_method' => '1',
            'discount' => null,
            'total' => '5886',
            'remark' => '附贈限量海報及小卡',
            'customer_id' => '7'
        ]);

        // WannaOne
        Order::create([
            'payment_method' => '0',
            'discount' => null,
            'total' => '4980',
            'remark' => '附贈簽名海報及特別小卡',
            'customer_id' => '8'
        ]);





        DB::table('order_details')->delete();

        // BTS
        OrderDetail::create([
            'order_id' => '1',
            'product_id' => '18',
            'name' => 'LOVE YOURSELF 承 Her',
            'price' => '498',
            'num' => '1'
        ]);
        OrderDetail::create([
            'order_id' => '1',
            'product_id' => '17',
            'name' => 'You Never Walk Alone',
            'price' => '588',
            'num' => '2'
        ]);
        OrderDetail::create([
            'order_id' => '1',
            'product_id' => '16',
            'name' => 'WINGS',
            'price' => '498',
            'num' => '2'
        ]);

        OrderDetail::create([
            'order_id' => '2',
            'product_id' => '15',
            'name' => 'Young Forever',
            'price' => '678',
            'num' => '3'
        ]);
        OrderDetail::create([
            'order_id' => '2',
            'product_id' => '14',
            'name' => '花樣年華 pt.2',
            'price' => '458',
            'num' => '3'
        ]);
        OrderDetail::create([
            'order_id' => '2',
            'product_id' => '13',
            'name' => '花樣年華 pt.1',
            'price' => '448',
            'num' => '3'
        ]);

        OrderDetail::create([
            'order_id' => '3',
            'product_id' => '12',
            'name' => 'Dark & Wild',
            'price' => '498',
            'num' => '4'
        ]);
        OrderDetail::create([
            'order_id' => '3',
            'product_id' => '11',
            'name' => 'Skool Luv Affair',
            'price' => '398',
            'num' => '5'
        ]);
        OrderDetail::create([
            'order_id' => '3',
            'product_id' => '10',
            'name' => 'O!RUL8,2?',
            'price' => '398',
            'num' => '5'
        ]);
        OrderDetail::create([
            'order_id' => '3',
            'product_id' => '9',
            'name' => '2 Cool 4 Skool',
            'price' => '358',
            'num' => '5'
        ]);

        // Got7
        OrderDetail::create([
            'order_id' => '4',
            'product_id' => '19',
            'name' => 'Got it?',
            'price' => '388',
            'num' => '5'
        ]);
        OrderDetail::create([
            'order_id' => '4',
            'product_id' => '20',
            'name' => 'GOT♡',
            'price' => '398',
            'num' => '5'
        ]);
        OrderDetail::create([
            'order_id' => '4',
            'product_id' => '21',
            'name' => 'Identify',
            'price' => '488',
            'num' => '5'
        ]);
        OrderDetail::create([
            'order_id' => '4',
            'product_id' => '22',
            'name' => 'Just Right',
            'price' => '398',
            'num' => '3'
        ]);

        OrderDetail::create([
            'order_id' => '5',
            'product_id' => '23',
            'name' => 'MAD',
            'price' => '398',
            'num' => '3'
        ]);
        OrderDetail::create([
            'order_id' => '5',
            'product_id' => '24',
            'name' => 'MAD Winter Edition',
            'price' => '968',
            'num' => '3'
        ]);

        OrderDetail::create([
            'order_id' => '6',
            'product_id' => '25',
            'name' => 'FLIGHT LOG:DEPARTURE',
            'price' => '398',
            'num' => '2'
        ]);
        OrderDetail::create([
            'order_id' => '6',
            'product_id' => '26',
            'name' => 'FLIGHT LOG:TURBULENCE',
            'price' => '518',
            'num' => '2'
        ]);
        OrderDetail::create([
            'order_id' => '6',
            'product_id' => '27',
            'name' => 'FLIGHT LOG:ARRIVAL',
            'price' => '468',
            'num' => '1'
        ]);
        OrderDetail::create([
            'order_id' => '6',
            'product_id' => '28',
            'name' => '7 FOR 7',
            'price' => '438',
            'num' => '1'
        ]);

        // Twice
        OrderDetail::create([
            'order_id' => '7',
            'product_id' => '33',
            'name' => 'The Story Begins',
            'price' => '428',
            'num' => '5'
        ]);
        OrderDetail::create([
            'order_id' => '7',
            'product_id' => '34',
            'name' => 'Page Two',
            'price' => '518',
            'num' => '5'
        ]);
        OrderDetail::create([
            'order_id' => '7',
            'product_id' => '35',
            'name' => 'TWICEcoaster:LANE 1',
            'price' => '518',
            'num' => '5'
        ]);
        OrderDetail::create([
            'order_id' => '7',
            'product_id' => '36',
            'name' => 'TWICEcoaster:LANE 2',
            'price' => '488',
            'num' => '5'
        ]);

        OrderDetail::create([
            'order_id' => '8',
            'product_id' => '37',
            'name' => 'SIGNAL',
            'price' => '488',
            'num' => '5'
        ]);
        OrderDetail::create([
            'order_id' => '8',
            'product_id' => '38',
            'name' => 'Twicetagram',
            'price' => '498',
            'num' => '5'
        ]);
        OrderDetail::create([
            'order_id' => '8',
            'product_id' => '39',
            'name' => 'Merry&Happy',
            'price' => '498',
            'num' => '5'
        ]);

        // Day6
        OrderDetail::create([
            'order_id' => '9',
            'product_id' => '29',
            'name' => 'The Day',
            'price' => '448',
            'num' => '5'
        ]);
        OrderDetail::create([
            'order_id' => '9',
            'product_id' => '30',
            'name' => 'DAYDREAM',
            'price' => '428',
            'num' => '5'
        ]);
        OrderDetail::create([
            'order_id' => '9',
            'product_id' => '31',
            'name' => 'SUNRISE',
            'price' => '480',
            'num' => '5'
        ]);
        OrderDetail::create([
            'order_id' => '9',
            'product_id' => '32',
            'name' => 'MOONRISE',
            'price' => '498',
            'num' => '5'
        ]);

        // Bigbang
        OrderDetail::create([
            'order_id' => '10',
            'product_id' => '1',
            'name' => 'BIGBANG MADE SERIES [M]',
            'price' => '418',
            'num' => '8'
        ]);
        OrderDetail::create([
            'order_id' => '10',
            'product_id' => '2',
            'name' => 'BIGBANG MADE SERIES [A]',
            'price' => '418',
            'num' => '4'
        ]);
        OrderDetail::create([
            'order_id' => '10',
            'product_id' => '3',
            'name' => 'BIGBANG MADE SERIES [D]',
            'price' => '418',
            'num' => '2'
        ]);
        OrderDetail::create([
            'order_id' => '10',
            'product_id' => '4',
            'name' => 'BIGBANG MADE SERIES [E]',
            'price' => '418',
            'num' => '5'
        ]);
        OrderDetail::create([
            'order_id' => '10',
            'product_id' => '5',
            'name' => 'BIGBANG MADE THE FULL ALBUM',
            'price' => '988',
            'num' => '2'
        ]);

        // HighLight
        OrderDetail::create([
            'order_id' => '11',
            'product_id' => '6',
            'name' => 'CAN YOU FEEL IT?',
            'price' => '468',
            'num' => '3'
        ]);
        OrderDetail::create([
            'order_id' => '11',
            'product_id' => '7',
            'name' => 'CALLING YOU',
            'price' => '498',
            'num' => '4'
        ]);
        OrderDetail::create([
            'order_id' => '11',
            'product_id' => '8',
            'name' => 'CELEBRATE',
            'price' => '498',
            'num' => '5'
        ]);

        // WannaOne
        OrderDetail::create([
            'order_id' => '12',
            'product_id' => '40',
            'name' => '1-1=0',
            'price' => '498',
            'num' => '5'
        ]);
        OrderDetail::create([
            'order_id' => '12',
            'product_id' => '41',
            'name' => '1X1=1',
            'price' => '498',
            'num' => '5'
        ]);
    }
}
