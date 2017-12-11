<?php

use Illuminate\Database\Seeder;

use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        Role::create([
            'name' => 'Admin',
            'description' => '最高權限管理者'
        ]);
        
        Role::create([
            'name' => 'User',
            'description' => '一般管理員'
        ]);

        Role::create([
            'name' => 'test1',
            'description' => '測試管理員1'
        ]);

        Role::create([
            'name' => 'test2',
            'description' => '測試管理員2'
        ]);
    }
}
