<?php

namespace App\Http\Requests;

use App\Models\SurveyResponder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSurveyResponderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('survey_responder_create');
    }

    public function rules()
    {
        return [
            'names'          => [
                'string',
                'nullable',
            ],
            'last_names'     => [
                'string',
                'nullable',
            ],
            'identification' => [
                'string',
                'nullable',
            ],
            'email'          => [
                'string',
                'nullable',
            ],
            'dob'            => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'company'        => [
                'string',
                'nullable',
            ],
            'position'       => [
                'string',
                'nullable',
            ],
        ];
    }
}
