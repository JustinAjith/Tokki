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
            [ // 13
                'category_id' => '3',
                'name' => 'Baby Dresses',
                'ref_id' => '91847543313'
            ],
            [ // 14
                'category_id' => '3',
                'name' => 'Boy\'s T-Shirts',
                'ref_id' => '929895465314'
            ],
            [ // 15
                'category_id' => '3',
                'name' => 'Boy\'s Jeans',
                'ref_id' => '959837465315'
            ],
            [ // 16
                'category_id' => '3',
                'name' => 'Tops & Tees (Girls)',
                'ref_id' => '027284465316'
            ],
            [ // 17
                'category_id' => '3',
                'name' => 'Boy\'s Shoes',
                'ref_id' => '229795367317'
            ],
            [ // 18
                'category_id' => '3',
                'name' => 'Girl\'s Shoes',
                'ref_id' => '33969442318'
            ],
            [ // 19
                'category_id' => '3',
                'name' => 'Toys',
                'ref_id' => '59997465319'
            ],
            [ // 20
                'category_id' => '4',
                'name' => 'Kids & Baby\'s Bags',
                'ref_id' => rand(00000000, 99999999).'420'
            ],
            [ // 21
                'category_id' => '4',
                'name' => 'Men\'s Shoes',
                'ref_id' => rand(00000000, 99999999).'421'
            ],
            [ // 22
                'category_id' => '4',
                'name' => 'Women\'s Shoes',
                'ref_id' => rand(00000000, 99999999).'422'
            ],
            [ // 23
                'category_id' => '4',
                'name' => 'Men\'s Sandals & Slippers',
                'ref_id' => rand(00000000, 99999999).'423'
            ],
            [ // 24
                'category_id' => '4',
                'name' => 'Women\'s Sandals & Slippers',
                'ref_id' => rand(00000000, 99999999).'424'
            ],
            [ // 25
                'category_id' => '4',
                'name' => 'Handbags',
                'ref_id' => rand(00000000, 99999999).'425'
            ],
            [ // 26
                'category_id' => '4',
                'name' => 'Other',
                'ref_id' => rand(00000000, 99999999).'426'
            ],

            [ // 27
                'category_id' => '5',
                'name' => 'Men\'s Bracelets & Bangles',
                'ref_id' => rand(00000000, 99999999).'527'
            ],
            [ // 28
                'category_id' => '5',
                'name' => 'Women\'s Bracelets & Bangles',
                'ref_id' => rand(00000000, 99999999).'528'
            ],
            [ // 29
                'category_id' => '5',
                'name' => 'Men\'s Rings',
                'ref_id' => rand(00000000, 99999999).'529'
            ],
            [ // 30
                'category_id' => '5',
                'name' => 'Women\'s Rings',
                'ref_id' => rand(00000000, 99999999).'530'
            ],
            [ // 31
                'category_id' => '5',
                'name' => 'Men\'s Chains & Pendants',
                'ref_id' => rand(00000000, 99999999).'531'
            ],
            [ // 32
                'category_id' => '5',
                'name' => 'Women\'s Chains & Pendants',
                'ref_id' => rand(00000000, 99999999).'532'
            ],
            [ // 33
                'category_id' => '5',
                'name' => 'Other',
                'ref_id' => rand(00000000, 99999999).'533'
            ],
        ];

        DB::table('sub_categories')->insert($data);
    }
}
