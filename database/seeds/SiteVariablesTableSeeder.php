<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteVariablesTableSeeder extends Seeder
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
                'name' => 'Email',
                'value' => 'justinajith94@gmail.com'
            ],
            [
                'name' => 'Phone',
                'value' => '+94 77 593 2985'
            ],
            [
                'name' => 'Address',
                'value' => 'No 100 4th Cross Street Jaffna, SriLanka'
            ],
            [
                'name' => 'Message',
                'value' => 'Welcome to Tokki'
            ]
        ];
        DB::table('site_variables')->insert($data);
    }
}
