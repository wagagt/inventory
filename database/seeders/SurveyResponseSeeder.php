<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SurveyResponse;

class SurveyResponseSeeder extends Seeder
{
    public function run()
    {
        $responses=[
            [
                'response'          => 'respuesta simple?',
                'survey_detail'     => 1,
                'survey_id'         => 1,
                'responder_id'      => 1,
            ],
            [
                'response'          => 'respuesta de parrafo',
                'survey_detail'     => 2,
                'survey_id'         => 1,
                'responder_id'      => 1,

            ],
            [
                'response'          => 'opt1, opt2, opt5',
                'survey_detail'     => 3,
                'survey_id'         => 1,
                'responder_id'      => 1,

            ],
            [
                'response'          => '80%',
                'survey_detail'     => 4,
                'survey_id'         => 1,
                'responder_id'      => 1,

            ],
        ];
        SurveyResponse::insert($responses);
    }
}
