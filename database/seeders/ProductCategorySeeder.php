<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_categories = [
            [
                'name' => 'Mueble de Sala',
                'description' => 'Mueble de Sala',
            ],
            [
                'name' => 'Mueble de Comedor',
                'description' => 'Mueble de Comedor',
            ],
            [
                'name' => 'Mueble de Oficina',
                'description' => 'Mueble de Oficina',
            ],
        ];
        ProductCategory::insert($product_categories);
    }
}
