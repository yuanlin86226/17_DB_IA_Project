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
    }
}