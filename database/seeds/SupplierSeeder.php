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
            'name' => 'YG Entertainment',
            'tax' => '52010819',
            'ceo' => '楊賢碩',
            'telephone' => '0231421104',
            'fax' => '0231421103',
            'email' => 'office@ygfamily.com',
            'address' => '首爾市麻浦區合井洞397-5號',
            'website' => 'http://www.ygfamily.com/'
        ]);
        Supplier::create([
            'name' => 'AroundUS Entertainment',
            'tax' => '52010320',
            'ceo' => '尹龍梁李孫',
            'telephone' => '02-546-2964',
            'fax' => '02-546-3964',
            'email' => 'office@aroundusent.com',
            'address' => '江南區狎鷗亭路79街37-1(清潭洞)',
            'website' => 'http://www.aroundusent.com/'
        ]);
    }
}
