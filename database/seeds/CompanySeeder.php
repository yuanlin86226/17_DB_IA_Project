<?php

use Illuminate\Database\Seeder;

use App\CompanyInfo;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_infos')->delete();

        CompanyInfo::create([
            'name' => '斯布奇科技',
            'tax' => '52010606',
            'website' => 'https://Spooky.com.tw',
            'email' => 'office@spooky.com.tw',
            'fax' => '22195011',
            'telephone' => '22195678',
            'address' => '台中市北區三民路三段129號',
            'ceo' => '斯布奇',
        ]);
    }
}
