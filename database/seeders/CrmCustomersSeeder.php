<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CrmCustomer;

class CrmCustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CrmCustomer::factory()->count(10)->create();
    }
}
