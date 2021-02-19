<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransactionType;

class TransactionTypesSeeder extends Seeder
{
    public function run()
    {
        $trasactionsTypes=[
            [
                'name'          =>  'Compra',
                'description'   =>  'Compra de Productos',
            ],
            [
                'name'          =>  'Venta',
                'description'   =>  'Venta de Productos',
            ],
            [
                'name'          =>  'Traslado',
                'description'   =>  'Traslado de Productos',
            ],
        ];
        TransactionType::insert($trasactionsTypes);
    }
}
