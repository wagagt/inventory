<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductTag;

class ProductsTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
$tags=[
    [
        'name'          =>   'Madera Caoba',
        'product_id'    =>   1,
    ],
            [
                'name'          =>   'Madera Palo Blanco',
                'product_id'    =>   1,
            ],
            [
                'name'          =>   'Madera Caoba',
                'product_id'    =>   2,
            ],
            [
                'name'          =>   'Madera Palo Blanco',
                'product_id'    =>   3,
            ],
];

        ProductTag::insert($tags);
    }
}
