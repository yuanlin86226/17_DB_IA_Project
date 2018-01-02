<?php

use Illuminate\Database\Seeder;

use App\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->delete();

        Customer::create([
            'name' => 'ARMY',
            'sex' => 0,
            'birthday' => '1997-07-09',
            'email' => 'army0709@gmail.com',
            'cellphone' => '0931498503',
            'address' => '台中市北區三民路三段122號'
        ]);

        Customer::create([
            'name' => 'Ahgase',
            'sex' => 0,
            'birthday' => '1997-05-09',
            'email' => 'ahgase0509@gmail.com',
            'cellphone' => '0931498501',
            'address' => '台中市北區三民路三段121號'
        ]);

        Customer::create([
            'name' => 'BLINK',
            'sex' => 1,
            'birthday' => '1997-01-14',
            'email' => 'blink0114@gmail.com',
            'cellphone' => '0931498502',
            'address' => '台中市北區三民路三段123號'
        ]);

        Customer::create([
            'name' => 'My Day',
            'sex' => 0,
            'birthday' => '1997-06-07',
            'email' => 'myday0607@gmail.com',
            'cellphone' => '0931498504',
            'address' => '台中市北區三民路三段125號'
        ]);

        Customer::create([
            'name' => 'ONCE',
            'sex' => 1,
            'birthday' => '1997-01-05',
            'email' => 'once0105@gmail.com',
            'cellphone' => '0931498505',
            'address' => '台中市北區三民路三段126號'
        ]);

        Customer::create([
            'name' => 'VIP',
            'sex' => 0,
            'birthday' => '1997-08-19',
            'email' => 'vip0819@gmail.com',
            'cellphone' => '0931498506',
            'address' => '台中市北區三民路三段127號'
        ]);

        Customer::create([
            'name' => 'LIGHT',
            'sex' => 0,
            'birthday' => '1997-06-02',
            'email' => 'light0602@gmail.com',
            'cellphone' => '0931498507',
            'address' => '台中市北區三民路三段128號'
        ]);

        Customer::create([
            'name' => 'WANNBLE',
            'sex' => 0,
            'birthday' => '1997-07-07',
            'email' => 'wannble0707@gmail.com',
            'cellphone' => '0931498508',
            'address' => '台中市北區三民路三段129號'
        ]);

        Customer::create([
            'name' => 'SONE',
            'sex' => 1,
            'birthday' => '1997-08-05',
            'email' => 'sone0805@gmail.com',
            'cellphone' => '0931498509',
            'address' => '台中市北區三民路三段130號'
        ]);
    }
}
