<?php

namespace App\Http\Requests;

use App\Models\SurveyDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSurveyDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('survey_detail_edit');
    }

    public function rules()
    {
        return [
            'ask' => [
                'string',
                'nullable',
            ],
        ];
    }
}
