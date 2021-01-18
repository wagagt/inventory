<?php

namespace App\Http\Requests;

use App\Models\SurveyAsk;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSurveyAskRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('survey_ask_edit');
    }

    public function rules()
    {
        return [
            'ask'    => [
                'string',
                'nullable',
            ],
            'answer' => [
                'string',
                'nullable',
            ],
        ];
    }
}
