<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
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
                'code' => 'TK0001',
                'name' => 'Tokki',
                'email' => 'jajith60@gmail.com',
                'password' => Hash::make('ajith1'),
                'bid' => '200',
                'total_bid' => '200',
            ]
        ];

        DB::table('users')->insert($data);
    }
}
