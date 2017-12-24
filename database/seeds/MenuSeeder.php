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
            'parent' => null
        ]);

        Menu::create([
            'icon' => 'pe-7s-box2',
            'title' => '帳號管理',
            'href' => '/admin/user',
            'parent' => '1'
        ]);
        Menu::create([
            'icon' => 'pe-7s-box2',
            'title' => '群組管理',
            'href' => '/admin/role',
            'parent' => '1'
        ]);
        Menu::create([
            'icon' => 'pe-7s-box2',
            'title' => '選單管理',
            'href' => '/admin/menu',
            'parent' => '1'
        ]);

        Menu::create([
            'icon' => 'pe-7s-note2',
            'title' => '基本資料管理',
            'href' => '#',
            'parent' => null
        ]);

        Menu::create([
            'icon' => 'pe-7s-box2',
            'title' => '公司資料',
            'href' => '/admin/company',
            'parent' => '5'
        ]);
        Menu::create([
            'icon' => 'pe-7s-box2',
            'title' => '員工資料',
            'href' => '/admin/employee',
            'parent' => '5'
        ]);
        Menu::create([
            'icon' => 'pe-7s-box2',
            'title' => '客戶資料',
            'href' => '/admin/customer',
            'parent' => '5'
        ]);
        Menu::create([
            'icon' => 'pe-7s-box2',
            'title' => '廠商資料',
            'href' => '/admin/supplier',
            'parent' => '5'
        ]);
        Menu::create([
            'icon' => 'pe-7s-box2',
            'title' => '商品分類',
            'href' => '/admin/productType',
            'parent' => '5'
        ]);
        Menu::create([
            'icon' => 'pe-7s-box2',
            'title' => '商品資料',
            'href' => '/admin/productData',
            'parent' => '5'
        ]);

    }
}
