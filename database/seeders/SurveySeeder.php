<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Survey;

class SurveySeeder extends Seeder
{
    public function run()
    {
        $surveys=[
            [
                'name'          => 'encuesta uno',
                'description'   => 'descripcion uno',
                'date_start'    => '2021-02-14',
                'date_end'      => '2021-02-20',
                'ubication_id'  => 1,
                'user_id'       => 1,
            ],
            [
                'name'          => 'encuesta dos',
                'description'   => 'descripcion dos',
                'date_start'    => '2021-03-14',
                'date_end'      => '2021-03-20',
                'ubication_id'  => 2,
                'user_id'       => 1,
            ]
        ];

        Survey::insert($surveys);
    }
}
