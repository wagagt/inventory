<?php

namespace App\Http\Requests;

use App\Models\ProductSpec;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductSpecRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_spec_create');
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
