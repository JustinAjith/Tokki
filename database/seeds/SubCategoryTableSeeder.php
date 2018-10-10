<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategoryTableSeeder extends Seeder
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
                'category_id' => '1',
                'name' => 'Dresses',
                'ref_id' => '5796541211'
            ],
            [ // 2
                'category_id' => '1',
                'name' => 'Blouses & Shirts',
                'ref_id' => '6987452412'
            ],
            [ // 3
                'category_id' => '1',
                'name' => 'Tops & Tees',
                'ref_id' => '9874539813'
            ],
            [ // 4
                'category_id' => '1',
                'name' => 'Jeans & Pants',
                'ref_id' => '6987524914'
            ],
            [ // 5
                'category_id' => '1',
                'name' => 'Lingerie & Sleepwear',
                'ref_id' => '6243759115'
            ],
            [ // 6
                'category_id' => '1',
                'name' => 'Other',
                'ref_id' => '3519765816'
            ],
            [ // 7
                'category_id' => '2',
                'name' => 'T-Shirts',
                'ref_id' => '1578463527'
            ],
            [ // 8
                'category_id' => '2',
                'name' => 'Shirts',
                'ref_id' => '3654795128'
            ],
            [ // 9
                'category_id' => '2',
                'name' => 'Jeans',
                'ref_id' => '7485963229'
            ],
            [// 10
                'category_id' => '2',
                'name' => 'Shorts',
                'ref_id' => '65482619210'
            ],
            [ // 11
                'category_id' => '2',
                'name' => 'Underwear',
                'ref_id' => '21435465211'
            ],
            [ // 12
                'category_id' => '2',
                'name' => 'Other',
                'ref_id' => '98543216212'
            ],
        ];

        DB::table('sub_categories')->insert($data);
    }
}
