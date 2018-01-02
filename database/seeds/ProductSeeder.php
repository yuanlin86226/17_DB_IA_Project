<?php

use Illuminate\Database\Seeder;

use App\Type;
use App\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->delete();

        // Type::create([
        //     'name' => '',
        //     'folder' => '',
        //     'discription' => '',
        //     'supplier_id' => ''
        // ]);

        Type::create([
            'name' => 'BTS',
            'folder' => 'BTS',
            'discription' => '韓國饒舌男子音樂組合，由V、Jin、Jimin、Jung Kook、RM、SUGA、j-hope七名成員組成，隸屬Big Hit Entertainment經紀公司旗下。
            團體剛出道時，防彈少年團的涵義為「阻擋像子彈一樣的批評與時代偏見的音樂團體」，2017年7月4日則加入了「不安於現狀，朝著夢想不斷成長的青春」的涵義，原先以「防彈少年團」為英文縮寫的「BTS」（Bangtan Sonyeon Dan），也增添了「Beyond The Scene」超越現狀的意思。
            防彈少年團歌迷的官方名稱為「A.R.M.Y」，ARMY在英文中是軍隊的意思，防彈衣和軍隊總是一起的，也有粉絲們也和防彈少年團一直一起的意思。同時也是「 Adorable Representative M.C for Youth 」的縮寫（值得人景仰的青年饒舌代表）',
            'supplier_id' => '1'
        ]);

        Type::create([
            'name' => 'GOT7',
            'folder' => 'GOT7',
            'discription' => '',
            'supplier_id' => '2'
        ]);

        Type::create([
            'name' => 'BLACKPINK',
            'folder' => 'BLACKPINK',
            'discription' => '',
            'supplier_id' => '3'
        ]);

        Type::create([
            'name' => '',
            'folder' => 'DAY6',
            'discription' => '',
            'supplier_id' => '4'
        ]);

        Type::create([
            'name' => '',
            'folder' => 'TWICE',
            'discription' => '',
            'supplier_id' => '5'
        ]);

        Type::create([
            'name' => 'BIGBANG',
            'folder' => 'BIGBANG',
            'discription' => 'YG娛樂於2006年推出的韓國男子音樂組合，由T.O.P、太陽、G-Dragon、大聲及勝利五名成員組成，G-Dragon擔任隊長一職，而他們的團體名稱「BIGBANG」為宇宙大爆炸之意(The Big Bang Theory)，意味著將對於韓國音樂界，甚至在全世界帶來爆炸性的影響，官方的歌迷名稱則是「V.I.P」，其意思為「Very Important People」，是根據第二張單曲《BIGBANG Is V.I.P》命名，有著粉絲是非常重要的人的含意。官方應援物為黃色皇冠造型手燈。',
            'supplier_id' => '6'
        ]);

        Type::create([
            'name' => 'HIGHLIGHT',
            'folder' => 'HIGHLIGHT',
            'discription' => '韓國的五人男子團體，前身為BEAST。現任成員有尹斗俊、龍俊亨、梁耀燮、李起光、孫東雲。2017年3月20日以全新的名字「Highlight」展開活動，寓意為最明亮的部分、最顯眼的存在。同年6月2日，公開新粉絲名為Light。',
            'supplier_id' => '7'
        ]);

        Type::create([
            'name' => '',
            'folder' => 'WannaOne',
            'discription' => '',
            'supplier_id' => '8'
        ]);

        Type::create([
            'name' => 'GIRLSGENERATION',
            'folder' => 'GIRLSGENERATION',
            'discription' => '',
            'supplier_id' => '9'
        ]);



        DB::table('products')->delete();

        Product::create([
            'name' => '',
            'photo' => '/image/products/BTS/',
            'price' => '',
            'total_amount' => '',
            'inventory' => '',
            'sales_amount' => '',
            'type_id' => ''
        ]);
        Product::create([
            'name' => 'BIGBANG MADE SERIES [M]',
            'photo' => '/image/products/BIGBANG/MadeSeriesM',
            'price' => '418',
            'total_amount' => '',
            'inventory' => '',
            'sales_amount' => '',
            'type_id' => ''
        ]);
        Product::create([
            'name' => 'BIGBANG MADE SERIES [A]',
            'photo' => '/image/products/BIGBANG/MadeSeriesA',
            'price' => '418',
            'total_amount' => '',
            'inventory' => '',
            'sales_amount' => '',
            'type_id' => ''
        ]);
        Product::create([
            'name' => 'BIGBANG MADE SERIES [D]',
            'photo' => '/image/products/BIGBANG/MadeSeriesD',
            'price' => '418',
            'total_amount' => '',
            'inventory' => '',
            'sales_amount' => '',
            'type_id' => ''
        ]);
        Product::create([
            'name' => 'BIGBANG MADE SERIES [E]',
            'photo' => '/image/products/BIGBANG/MadeSeriesE',
            'price' => '418',
            'total_amount' => '',
            'inventory' => '',
            'sales_amount' => '',
            'type_id' => ''
        ]);
        Product::create([
            'name' => 'BIGBANG MADE THE FULL ALBUM',
            'photo' => '/image/products/BIGBANG/MadeFullAlbum',
            'price' => '988',
            'total_amount' => '',
            'inventory' => '',
            'sales_amount' => '',
            'type_id' => ''
        ]);
        Product::create([
            'name' => 'CAN YOU FEEL IT?',
            'photo' => '/image/products/HIGHLIGHT/CanYouFeelIt',
            'price' => '468',
            'total_amount' => '',
            'inventory' => '',
            'sales_amount' => '',
            'type_id' => ''
        ]);
        Product::create([
            'name' => 'CALLING YOU',
            'photo' => '/image/products/HIGHLIGHT/CallingYou',
            'price' => '498',
            'total_amount' => '',
            'inventory' => '',
            'sales_amount' => '',
            'type_id' => ''
        ]);
        Product::create([
            'name' => 'CELEBRATE',
            'photo' => '/image/products/HIGHLIGHT/Celebrate',
            'price' => '498',
            'total_amount' => '',
            'inventory' => '',
            'sales_amount' => '',
            'type_id' => ''
        ]);
    }
}
