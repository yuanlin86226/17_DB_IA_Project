<?php

use Illuminate\Database\Seeder;

use App\Menu;
use App\MenuDetail;
use App\MenuUser;

class MenuDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_details')->delete();

        MenuDetail::create([
            'menu_id' => '2',
            'description' => '查看'
        ]);
        MenuDetail::create([
            'menu_id' => '2',
            'description' => '新增'
        ]);
        MenuDetail::create([
            'menu_id' => '2',
            'description' => '修改'
        ]);
        MenuDetail::create([
            'menu_id' => '2',
            'description' => '刪除'
        ]);


        MenuDetail::create([
            'menu_id' => '3',
            'description' => '查看'
        ]);
        MenuDetail::create([
            'menu_id' => '3',
            'description' => '新增'
        ]);
        MenuDetail::create([
            'menu_id' => '3',
            'description' => '修改'
        ]);
        MenuDetail::create([
            'menu_id' => '3',
            'description' => '刪除'
        ]);

        MenuDetail::create([
            'menu_id' => '4',
            'description' => '查看'
        ]);
        MenuDetail::create([
            'menu_id' => '4',
            'description' => '新增'
        ]);
        MenuDetail::create([
            'menu_id' => '4',
            'description' => '修改'
        ]);
        MenuDetail::create([
            'menu_id' => '4',
            'description' => '刪除'
        ]);



        MenuDetail::create([
            'menu_id' => '6',
            'description' => '查看'
        ]);
        MenuDetail::create([
            'menu_id' => '6',
            'description' => '新增'
        ]);
        MenuDetail::create([
            'menu_id' => '6',
            'description' => '修改'
        ]);
        MenuDetail::create([
            'menu_id' => '6',
            'description' => '刪除'
        ]);

        MenuDetail::create([
            'menu_id' => '7',
            'description' => '查看'
        ]);
        MenuDetail::create([
            'menu_id' => '7',
            'description' => '新增'
        ]);
        MenuDetail::create([
            'menu_id' => '7',
            'description' => '修改'
        ]);
        MenuDetail::create([
            'menu_id' => '7',
            'description' => '刪除'
        ]);

        MenuDetail::create([
            'menu_id' => '8',
            'description' => '查看'
        ]);
        MenuDetail::create([
            'menu_id' => '8',
            'description' => '新增'
        ]);
        MenuDetail::create([
            'menu_id' => '8',
            'description' => '修改'
        ]);
        MenuDetail::create([
            'menu_id' => '8',
            'description' => '刪除'
        ]);

        MenuDetail::create([
            'menu_id' => '9',
            'description' => '查看'
        ]);
        MenuDetail::create([
            'menu_id' => '9',
            'description' => '新增'
        ]);
        MenuDetail::create([
            'menu_id' => '9',
            'description' => '修改'
        ]);
        MenuDetail::create([
            'menu_id' => '9',
            'description' => '刪除'
        ]);

        MenuDetail::create([
            'menu_id' => '10',
            'description' => '查看'
        ]);
        MenuDetail::create([
            'menu_id' => '10',
            'description' => '新增'
        ]);
        MenuDetail::create([
            'menu_id' => '10',
            'description' => '修改'
        ]);
        MenuDetail::create([
            'menu_id' => '10',
            'description' => '刪除'
        ]);

        MenuDetail::create([
            'menu_id' => '11',
            'description' => '查看'
        ]);
        MenuDetail::create([
            'menu_id' => '11',
            'description' => '新增'
        ]);
        MenuDetail::create([
            'menu_id' => '11',
            'description' => '修改'
        ]);
        MenuDetail::create([
            'menu_id' => '11',
            'description' => '刪除'
        ]);

        $menu_details = MenuDetail::all();
        foreach ($menu_details as $menu) {
            MenuUser::create([
                'menu_id' => $menu['menu_id'],
                'menu_detail_id' => $menu['id'],
                'user_id' => '1'
            ]);
        }
        
    }
}
