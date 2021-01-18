<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Store;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::factory()->count(2)->create();
    }
}
