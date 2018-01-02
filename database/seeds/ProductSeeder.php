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

        // Type::create([
        //     'name' => 'GOT7',
        //     'folder' => 'GOT7',
        //     'discription' => '',
        //     'supplier_id' => '2'
        // ]);

        // Type::create([
        //     'name' => '',
        //     'folder' => 'BLACKPINK',
        //     'discription' => '',
        //     'supplier_id' => ''
        // ]);

        // Type::create([
        //     'name' => '',
        //     'folder' => 'DAY6',
        //     'discription' => '',
        //     'supplier_id' => ''
        // ]);

        // Type::create([
        //     'name' => '',
        //     'folder' => 'TWICE',
        //     'discription' => '',
        //     'supplier_id' => ''
        // ]);

        // Type::create([
        //     'name' => '',
        //     'folder' => 'BIGBANG',
        //     'discription' => '',
        //     'supplier_id' => ''
        // ]);

        // Type::create([
        //     'name' => '',
        //     'folder' => 'Highlight',
        //     'discription' => '',
        //     'supplier_id' => ''
        // ]);

        // Type::create([
        //     'name' => '',
        //     'folder' => 'WannaOne',
        //     'discription' => '',
        //     'supplier_id' => ''
        // ]);

        // Type::create([
        //     'name' => '',
        //     'folder' => 'GirlsGeneration',
        //     'discription' => '',
        //     'supplier_id' => ''
        // ]);



        // DB::table('products')->delete();

        // Product::create([
        //     'name' => '',
        //     'photo' => '/image/products/BTS/',
        //     'price' => '',
        //     'total_amount' => '',
        //     'inventory' => '',
        //     'sales_amount' => '',
        //     'type_id' => ''
        // ]);
    }
}
