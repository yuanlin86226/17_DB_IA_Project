<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(MenuDetailSeeder::class);

        $this->call(CompanySeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(OrderSeeder::class);
    }
}
