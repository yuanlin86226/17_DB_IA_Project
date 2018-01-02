<?php

use Illuminate\Database\Seeder;

use App\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Supplier::create([
        //     'name' => '',
        //     'tax' => '',
        //     'ceo' => '',
        //     'telephone' => '',
        //     'fax' => '',
        //     'email' => '',
        //     'address' => '',
        //     'website' => ''
        // ]);

        DB::table('suppliers')->delete();

        Supplier::create([
            'name' => 'BigHit',
            'tax' => '52010202',
            'ceo' => '方時赫',
            'telephone' => '027417732',
            'fax' => '027417731',
            'email' => 'bighit@gmail.com',
            'address' => ' 韓國首爾特別市江南區論峴洞10-31號青丘大樓2樓',
            'website' => 'http://bts.ibighit.com/'
        ]);

        Supplier::create([
            'name' => 'JYP Entertainment',
            'tax' => '52010707',
            'ceo' => '朴軫永',
            'telephone' => '82-2-3438-2300',
            'fax' => '82-2-3438-2301',
            'email' => 'business@jype.com',
            'address' => '首爾市江南區狎鷗亭路79街41號JYP中心',
            'website' => 'http://www.jype.com'
        ]);
    }
}
