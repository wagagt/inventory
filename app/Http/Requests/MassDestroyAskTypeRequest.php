<?php

namespace App\Http\Requests;

use App\Models\AskType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAskTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ask_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:ask_types,id',
        ];
    }
}
