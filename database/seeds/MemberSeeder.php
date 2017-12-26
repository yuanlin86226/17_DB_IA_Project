<?php

use Illuminate\Database\Seeder;

use App\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->delete();

        Member::create([
            'job' => '工程師',
            'name' => '林俞安',
            'identity_id' => '1310634008',
            'sex' => 0,
            'birthday' => '1997-02-26',
            'cellphone' => '0931226767',
            'address' => '台中市烏日區九德里中華路182號',
            'start_date' => '2017-12-25',
            'end_date' => null,
        ]);

        Member::create([
            'job' => '工程師',
            'name' => '馮莉茵',
            'identity_id' => '1310634015',
            'sex' => 0,
            'birthday' => '1997-05-08',
            'cellphone' => '0988874857',
            'address' => '台中市大里區益民路二段355號7樓',
            'start_date' => '2017-12-25',
            'end_date' => null,
        ]);

        Member::create([
            'job' => '設計師',
            'name' => '李均容',
            'identity_id' => '1310634005',
            'sex' => 0,
            'birthday' => '1997-05-04',
            'cellphone' => '0986054225',
            'address' => '台中市太平區文林街56號',
            'start_date' => '2017-12-25',
            'end_date' => null,
        ]);
    }
}
