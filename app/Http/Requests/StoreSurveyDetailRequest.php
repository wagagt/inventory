<?php

namespace App\Http\Requests;

use App\Models\SurveyDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSurveyDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('survey_detail_create');
    }

    public function rules()
    {
        return [
            'ask'      => [
                'string',
                'nullable',
            ],
            'response' => [
                'string',
                'nullable',
            ],
        ];
    }
}
