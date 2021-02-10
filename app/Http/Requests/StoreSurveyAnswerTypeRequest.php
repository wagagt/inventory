<?php

namespace App\Http\Requests;

use App\Models\SurveyAnswerType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSurveyAnswerTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('survey_answer_type_create');
    }

    public function rules()
    {
        return [
            'name'  => [
                'string',
                'nullable',
            ],
            'value' => [
                'string',
                'nullable',
            ],
        ];
    }
}
