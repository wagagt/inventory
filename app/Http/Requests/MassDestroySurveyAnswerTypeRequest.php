<?php

namespace App\Http\Requests;

use App\Models\SurveyAnswerType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySurveyAnswerTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('survey_answer_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:survey_answer_types,id',
        ];
    }
}
