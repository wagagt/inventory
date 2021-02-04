<?php

namespace Database\Seeders;

use App\Models\SurveyUbication;
use Illuminate\Database\Seeder;

class SurveyUbicationsSeeder extends Seeder
{
    public function run()
    {
        $ubications = [
            [
                'id'            =>  1,
                'name'          => 'Municipalidad Guatemala',
                'address'       => '32 av 23-33',
                'zone'          => 1,
                'city'          => 'Guatemala',
                'department'    => 'Guatemala',
            ],
            [
                'id'            =>  2,
                'name'          => 'Municipalidad Villa Nueva',
                'address'       => '40 calle C 12-1',
                'zone'          => 1,
                'city'          => 'Villa Nueva',
                'department'    => 'Guatemala',

            ],
            [
                'id'            =>  3,
                'name'          => 'MiniMuni Plaza Esapaña',
                'address'       => '13 calle 12-2',
                'zone'          => 9,
                'city'          => 'Guatemala',
                'department'    => 'Guatemala',

            ],
        ];
        // dd($ubications);
        SurveyUbication::insert($ubications);

    }
}
