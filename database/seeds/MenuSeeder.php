<?php

use Illuminate\Database\Seeder;

use App\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->delete();

        Menu::create([
            'icon' => 'pe-7s-config',
            'title' => '系統管理',
            'href' => '#',
            'parent' => null,
            'order' => '1'
        ]);

        Menu::create([
            'icon' => 'pe-7s-box2',
            'title' => '帳號管理',
            'href' => '/admin/user',
            'parent' => '1',
            'order' => '2'
        ]);
        Menu::create([
            'icon' => 'pe-7s-box2',
            'title' => '群組管理',
            'href' => '/admin/role',
            'parent' => '1',
            'order' => '3'
        ]);
        Menu::create([
            'icon' => 'pe-7s-box2',
            'title' => '權限管理',
            'href' => '/admin/menu',
            'parent' => '1',
            'order' => '4'
        ]);

        Menu::create([
            'icon' => 'pe-7s-config',
            'title' => '基本資料管理',
            'href' => '#',
            'parent' => null,
            'order' => '5'
        ]);

        Menu::create([
            'icon' => 'pe-7s-box2',
            'title' => '公司資料',
            'href' => '/admin/company',
            'parent' => '5',
            'order' => '6'
        ]);
        Menu::create([
            'icon' => 'pe-7s-box2',
            'title' => '員工資料',
            'href' => '/admin/employee',
            'parent' => '5',
            'order' => '7'
        ]);
        Menu::create([
            'icon' => 'pe-7s-box2',
            'title' => '客戶資料',
            'href' => '/admin/customer',
            'parent' => '5',
            'order' => '8'
        ]);
        Menu::create([
            'icon' => 'pe-7s-box2',
            'title' => '廠商資料',
            'href' => '/admin/supplier',
            'parent' => '5',
            'order' => '9'
        ]);
        Menu::create([
            'icon' => 'pe-7s-box2',
            'title' => '商品分類',
            'href' => '/admin/productType',
            'parent' => '5',
            'order' => '10'
        ]);
        Menu::create([
            'icon' => 'pe-7s-box2',
            'title' => '商品資料',
            'href' => '/admin/productData',
            'parent' => '5',
            'order' => '11'
        ]);

    }
}