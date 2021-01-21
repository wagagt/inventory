<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provider;
class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provider::factory()->count(10)->create();
    }
}
