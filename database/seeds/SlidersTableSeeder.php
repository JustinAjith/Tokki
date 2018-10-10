<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlidersTableSeeder extends Seeder
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
                'image' => '758613.jpg',
                'title' => 'Title one',
                'text' => 'This is a example title one',
                'status' => 'yes',
            ],
            [
                'image' => '59672429.jpg',
                'title' => 'Title Two',
                'text' => '',
                'status' => 'yes',
            ],
            [
                'image' => '43842369.jpg',
                'title' => 'Title Three',
                'text' => '',
                'status' => 'yes',
            ]
        ];

        DB::table('sliders')->insert($data);
    }
}
