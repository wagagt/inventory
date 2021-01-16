<?php

namespace App\Http\Requests;

use App\Models\Provider;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProviderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('provider_create');
    }

    public function rules()
    {
        return [
            'name'          => [
                'string',
                'nullable',
            ],
            'address'       => [
                'string',
                'nullable',
            ],
            'zone'          => [
                'string',
                'nullable',
            ],
            'city'          => [
                'string',
                'nullable',
            ],
            'department'    => [
                'string',
                'nullable',
            ],
            'contact_name'  => [
                'string',
                'nullable',
            ],
            'contact_phone' => [
                'string',
                'nullable',
            ],
        ];
    }
}
