<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'J Ajith',
            'email' => 'jajith60@gmail.com',
            'password' => Hash::make('ajith1'),
            'remember_token' => str_random(20),
        ];

        DB::table('admins')->insert($data);
    }
}
