<?php

use Illuminate\Database\Seeder;

use App\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->delete();

        Employee::create([
            'job' => '工程師',
            'name' => '林俞安',
            'identity_id' => '1310634008',
            'sex' => 0,
            'birthday' => '1997-02-26',
            'email' => 's1310634008@gms.nutc.edu.tw',
            'cellphone' => '0931226767',
            'address' => '台中市烏日區九德里中華路182號',
            'start_date' => '2017-12-25',
            'end_date' => null,
        ]);

        Employee::create([
            'job' => '工程師',
            'name' => '馮莉茵',
            'identity_id' => '1310634015',
            'sex' => 0,
            'birthday' => '1997-05-08',
            'email' => 's1310634015@gms.nutc.edu.tw',
            'cellphone' => '0988874857',
            'address' => '台中市大里區益民路二段355號7樓',
            'start_date' => '2017-12-25',
            'end_date' => null,
        ]);

        Employee::create([
            'job' => '設計師',
            'name' => '李均容',
            'identity_id' => '1310634005',
            'sex' => 0,
            'birthday' => '1997-05-04',
            'cellphone' => '0986054225',
            'email' => 's1310634005@gms.nutc.edu.tw',
            'address' => '台中市太平區文林街56號',
            'start_date' => '2017-12-25',
            'end_date' => null,
        ]);

        Employee::create([
            'job' => '櫃台',
            'name' => '王美',
            'identity_id' => 'L225346537',
            'sex' => 0,
            'birthday' => '1997-04-20',
            'cellphone' => '0910694854',
            'email' => 'wangmei@gmail.com',
            'address' => '台中市西區三民路一段50巷8號',
            'start_date' => '2017-12-25',
            'end_date' => null,
        ]);

        Employee::create([
            'job' => '櫃台',
            'name' => '王帥',
            'identity_id' => 'L125346537',
            'sex' => 1,
            'birthday' => '1997-04-20',
            'cellphone' => '0910694864',
            'email' => 'wangshy@gmail.com',
            'address' => '台中市西區三民路一段50巷8號',
            'start_date' => '2017-12-25',
            'end_date' => null,
        ]);
    }
}
