<?php

use Illuminate\Database\Seeder;

use App\Menu;
use App\MenuDetail;
use App\MenuRole;

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
            'sign' => 'view',
            'description' => '查看'
        ]);
        MenuDetail::create([
            'menu_id' => '2',
            'sign' => 'insert',
            'description' => '新增'
        ]);
        MenuDetail::create([
            'menu_id' => '2',
            'sign' => 'edit',
            'description' => '修改'
        ]);
        MenuDetail::create([
            'menu_id' => '2',
            'sign' => 'delete',
            'description' => '刪除'
        ]);


        MenuDetail::create([
            'menu_id' => '3',
            'sign' => 'view',
            'description' => '查看'
        ]);
        MenuDetail::create([
            'menu_id' => '3',
            'sign' => 'insert',
            'description' => '新增'
        ]);
        MenuDetail::create([
            'menu_id' => '3',
            'sign' => 'edit',
            'description' => '修改'
        ]);
        MenuDetail::create([
            'menu_id' => '3',
            'sign' => 'delete',
            'description' => '刪除'
        ]);

        MenuDetail::create([
            'menu_id' => '4',
            'sign' => 'view',
            'description' => '查看'
        ]);
        MenuDetail::create([
            'menu_id' => '4',
            'sign' => 'insert',
            'description' => '新增'
        ]);
        MenuDetail::create([
            'menu_id' => '4',
            'sign' => 'edit',
            'description' => '修改'
        ]);
        MenuDetail::create([
            'menu_id' => '4',
            'sign' => 'delete',
            'description' => '刪除'
        ]);



        MenuDetail::create([
            'menu_id' => '6',
            'sign' => 'view',
            'description' => '查看'
        ]);
        MenuDetail::create([
            'menu_id' => '6',
            'sign' => 'insert',
            'description' => '新增'
        ]);
        MenuDetail::create([
            'menu_id' => '6',
            'sign' => 'edit',
            'description' => '修改'
        ]);
        MenuDetail::create([
            'menu_id' => '6',
            'sign' => 'delete',
            'description' => '刪除'
        ]);

        MenuDetail::create([
            'menu_id' => '7',
            'sign' => 'view',
            'description' => '查看'
        ]);
        MenuDetail::create([
            'menu_id' => '7',
            'sign' => 'insert',
            'description' => '新增'
        ]);
        MenuDetail::create([
            'menu_id' => '7',
            'sign' => 'edit',
            'description' => '修改'
        ]);
        MenuDetail::create([
            'menu_id' => '7',
            'sign' => 'delete',
            'description' => '刪除'
        ]);

        MenuDetail::create([
            'menu_id' => '8',
            'sign' => 'view',
            'description' => '查看'
        ]);
        MenuDetail::create([
            'menu_id' => '8',
            'sign' => 'insert',
            'description' => '新增'
        ]);
        MenuDetail::create([
            'menu_id' => '8',
            'sign' => 'edit',
            'description' => '修改'
        ]);
        MenuDetail::create([
            'menu_id' => '8',
            'sign' => 'delete',
            'description' => '刪除'
        ]);

        MenuDetail::create([
            'menu_id' => '9',
            'sign' => 'view',
            'description' => '查看'
        ]);
        MenuDetail::create([
            'menu_id' => '9',
            'sign' => 'insert',
            'description' => '新增'
        ]);
        MenuDetail::create([
            'menu_id' => '9',
            'sign' => 'edit',
            'description' => '修改'
        ]);
        MenuDetail::create([
            'menu_id' => '9',
            'sign' => 'delete',
            'description' => '刪除'
        ]);

        MenuDetail::create([
            'menu_id' => '10',
            'sign' => 'view',
            'description' => '查看'
        ]);
        MenuDetail::create([
            'menu_id' => '10',
            'sign' => 'insert',
            'description' => '新增'
        ]);
        MenuDetail::create([
            'menu_id' => '10',
            'sign' => 'edit',
            'description' => '修改'
        ]);
        MenuDetail::create([
            'menu_id' => '10',
            'sign' => 'delete',
            'description' => '刪除'
        ]);

        MenuDetail::create([
            'menu_id' => '11',
            'sign' => 'view',
            'description' => '查看'
        ]);
        MenuDetail::create([
            'menu_id' => '11',
            'sign' => 'insert',
            'description' => '新增'
        ]);
        MenuDetail::create([
            'menu_id' => '11',
            'sign' => 'edit',
            'description' => '修改'
        ]);
        MenuDetail::create([
            'menu_id' => '11',
            'sign' => 'delete',
            'description' => '刪除'
        ]);

        DB::table('menu_role')->delete();

        $menu_details = MenuDetail::all();
        
        $i = 1;
        foreach ($menu_details as $menu) {
            if($i != $menu['menu_id']){
                MenuRole::create([
                    'menu_id' => $i,
                    'menu_detail_id' => null,
                    'role_id' => '1'
                ]);

                $i++;
            }

            MenuRole::create([
                'menu_id' => $menu['menu_id'],
                'menu_detail_id' => $menu['id'],
                'role_id' => '1'
            ]);
        }


        
        MenuRole::create([
            'menu_id' => '1',
            'menu_detail_id' => null,
            'role_id' => '3'
        ]);

        MenuRole::create([
            'menu_id' => '2',
            'menu_detail_id' => '1',
            'role_id' => '3'
        ]);
        MenuRole::create([
            'menu_id' => '2',
            'menu_detail_id' => '2',
            'role_id' => '3'
        ]);
        MenuRole::create([
            'menu_id' => '2',
            'menu_detail_id' => '3',
            'role_id' => '3'
        ]);
        MenuRole::create([
            'menu_id' => '2',
            'menu_detail_id' => '4',
            'role_id' => '3'
        ]);

        MenuRole::create([
            'menu_id' => '3',
            'menu_detail_id' => '5',
            'role_id' => '4'
        ]);
        MenuRole::create([
            'menu_id' => '3',
            'menu_detail_id' => '6',
            'role_id' => '4'
        ]);
        MenuRole::create([
            'menu_id' => '3',
            'menu_detail_id' => '7',
            'role_id' => '4'
        ]);
        MenuRole::create([
            'menu_id' => '3',
            'menu_detail_id' => '8',
            'role_id' => '4'
        ]);

        MenuRole::create([
            'menu_id' => '5',
            'menu_detail_id' => null,
            'role_id' => '4'
        ]);
        MenuRole::create([
            'menu_id' => '6',
            'menu_detail_id' => '13',
            'role_id' => '4'
        ]);
        MenuRole::create([
            'menu_id' => '6',
            'menu_detail_id' => '14',
            'role_id' => '4'
        ]);
        MenuRole::create([
            'menu_id' => '6',
            'menu_detail_id' => '15',
            'role_id' => '4'
        ]);
        MenuRole::create([
            'menu_id' => '6',
            'menu_detail_id' => '16',
            'role_id' => '4'
        ]);
        
    }
}
