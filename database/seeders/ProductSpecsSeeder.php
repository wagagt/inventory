<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\ProductSpec;

class ProductSpecsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specs = [
            [
                'name'  => 'madera',
                'value' => 'caoba',
                'inputy_type'   => 'string|require',
                'product_id'    => 1
            ],
            [
                'name'  => 'medidas',
                'value' => '3x5x2',
                'inputy_type'   => 'string|require',
                'product_id'    => 1
            ],
            [
                'name'  => 'imagen',
                'value' => '/images/producto_1.png',
                'inputy_type'   => 'string|require',
                'product_id'    => 1
            ],
        ];
        ProductSpec::insert($specs);
    }
}
