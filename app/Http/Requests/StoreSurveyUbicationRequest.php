<?php

namespace App\Http\Requests;

use App\Models\SurveyUbication;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSurveyUbicationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('survey_ubication_create');
    }

    public function rules()
    {
        return [
            'name'       => [
                'string',
                'nullable',
            ],
            'address'    => [
                'string',
                'nullable',
            ],
            'zone'       => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'city'       => [
                'string',
                'nullable',
            ],
            'department' => [
                'string',
                'nullable',
            ],
        ];
    }
}
