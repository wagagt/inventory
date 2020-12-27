<?php

namespace App\Http\Requests;

use App\Models\TransactionType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTransactionTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_type_create');
    }

    public function rules()
    {
        return [
            'name'        => [
                'string',
                'nullable',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
