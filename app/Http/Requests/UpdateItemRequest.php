<?php

namespace App\Http\Requests;

use App\Models\Item;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateItemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('item_edit');
    }

    public function rules()
    {
        return [
            'serial_number'      => [
                'string',
                'nullable',
            ],
            'transaction_detail' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
