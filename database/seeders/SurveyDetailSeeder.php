<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SurveyDetail;

class SurveyDetailSeeder extends Seeder
{
    public function run()
    {
$surveyDetails  =[
            [
                'ask'               => 'pregunta simple',
                'survey_id'         =>  1,
                'answer_type_id'    =>  1,
            ],
            [
                'ask'               => 'pregunta parrafo',
                'survey_id'         =>  1,
                'answer_type_id'    =>  2,
            ],
            [
                'ask'               => 'seleccion multiple',
                'survey_id'         =>  1,
                'answer_type_id'    =>  3,
            ],
            [
                'ask'               => 'pregunta de rango de valor',
                'survey_id'         =>  1,
                'answer_type_id'    =>  4,
            ]
];
        SurveyDetail::insert($surveyDetails);

    }
}
