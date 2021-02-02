<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SurveyAnswerType;

class SurveyAnswerTypeSeeder extends Seeder
{
    public function run()
    {
        $surveyAnswerType = [
            [
                'name'  => 'Respuesta de texto corto',
                'value'  => 'text',
            ],
            [
                'name'  => 'Respuesta de parrafo',
                'value'  => 'textarea',
            ],
            [
                'name'  => 'Respuesta de seleccion multiple',
                'value'  => 'checklist',
            ],
            [
                'name'  => 'Respuesta de rango de valor',
                'value'  => 'slider',
            ],
        ];
    SurveyAnswerType::insert($surveyAnswerType);
    }
}
