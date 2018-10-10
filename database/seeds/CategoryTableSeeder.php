<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ // 1
                'name' => 'Women\'s Clothing'
            ],
            [ // 2
                'name' => 'Men\'s Clothing'
            ],
            [ // 3
                'name' => 'Kids and Baby'
            ],
            [ // 4
                'name' => 'Bags and Shoes'
            ],
            [ // 5
                'name' => 'Jewelries'
            ],
            [ // 6
                'name' => 'Watches'
            ],
            [ // 7
                'name' => 'Fashion Accessories'
            ],
            [ // 8
                'name' => 'Phones and Accessories'
            ],
            [ // 9
                'name' => 'Computer and Office'
            ],
            [ // 10
                'name' => 'Home and Furniture'
            ]
        ];

        DB::table('categories')->insert($data);
    }
}
