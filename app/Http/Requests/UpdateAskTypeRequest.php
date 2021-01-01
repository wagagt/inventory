<?php

namespace App\Http\Requests;

use App\Models\AskType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAskTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ask_type_edit');
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
