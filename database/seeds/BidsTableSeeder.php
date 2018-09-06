<?php

use Illuminate\Database\Seeder;

class BidsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'from' => '0',
                'to' => '99',
                'bid' => '5'
            ],
            [
                'from' => '100',
                'to' => '499',
                'bid' => '25'
            ],
            [
                'from' => '500',
                'to' => '999',
                'bid' => '75'
            ],
            [
                'from' => '1000',
                'to' => '4999',
                'bid' => '125'
            ],
            [
                'from' => '5000',
                'to' => '9999',
                'bid' => '200'
            ],
        ];

        DB::table('bid_rangs')->insert($data);
    }
}
