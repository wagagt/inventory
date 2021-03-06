<?php

namespace App\Http\Requests;

use App\Models\SurveyResponse;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSurveyResponseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('survey_response_create');
    }

    public function rules()
    {
        return [
            'response'      => [
                'string',
                'nullable',
            ],
            'survey_detail' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
