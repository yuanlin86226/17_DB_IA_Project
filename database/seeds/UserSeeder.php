<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $user = User::create([
            'userName' => 'Admin',
            'name' => 'poor student',
        	'email' => 'admin@example.com',
        	'password' => bcrypt('admin'),
            'phoneNumber' => null,
            'lastLoginAt' => null,
            'lastLoginIP' => null,
            'lastLoginAgent' => null,
        	'remember_token' => str_random(10)
        ]);

        $role_admin = Role::where('name', 'Admin')->first();
        $user->roles()->attach($role_admin);


        $user2 = User::create([
            'userName' => 'yuanlin',
            'name' => 'yuanlin',
        	'email' => 'sonia86226@gmail.com',
        	'password' => bcrypt('sonia26'),
            'phoneNumber' => null,
            'lastLoginAt' => null,
            'lastLoginIP' => null,
            'lastLoginAgent' => null,
        	'remember_token' => str_random(10)
        ]);

        $role_admin = Role::where('name', 'test1')->first();
        $user2->roles()->attach($role_admin);

        $role_admin = Role::where('name', 'test2')->first();
        $user2->roles()->attach($role_admin);
    }
}
