<?php

namespace App\Http\Requests;

use App\Models\Store;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStoreRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('store_create');
    }

    public function rules()
    {
        return [
            'name'       => [
                'string',
                'required',
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
            'users.*'    => [
                'integer',
            ],
            'users'      => [
                'array',
            ],
        ];
    }
}
