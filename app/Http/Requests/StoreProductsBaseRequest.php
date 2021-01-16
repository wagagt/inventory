<?php

namespace App\Http\Requests;

use App\Models\ProductsBase;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductsBaseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('products_base_create');
    }

    public function rules()
    {
        return [
            'name'         => [
                'string',
                'nullable',
            ],
            'description'  => [
                'string',
                'nullable',
            ],
            'stock'        => [
                'string',
                'nullable',
            ],
            'min_stock'    => [
                'string',
                'nullable',
            ],
            'max_stock'    => [
                'string',
                'nullable',
            ],
            'categories.*' => [
                'integer',
            ],
            'categories'   => [
                'array',
            ],
            'providers.*'  => [
                'integer',
            ],
            'providers'    => [
                'array',
            ],
            'store_id'     => [
                'required',
                'integer',
            ],
        ];
    }
}
