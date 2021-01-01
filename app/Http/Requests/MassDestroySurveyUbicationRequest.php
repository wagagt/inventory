<?php

namespace App\Http\Requests;

use App\Models\SurveyUbication;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySurveyUbicationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('survey_ubication_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:survey_ubications,id',
        ];
    }
}
