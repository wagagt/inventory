<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Product;
use App\Models\Store;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countStore = Store::count();
        $countProduct = Product::count();

        for ($s = 1; $s < $countStore + 1; $s++) {
            for ($p = 1; $p < $countProduct + 1; $p++) {
                Item::factory()->create(['product_id' => $p, 'store_id' => $s]);
            }
        }

    }
}
