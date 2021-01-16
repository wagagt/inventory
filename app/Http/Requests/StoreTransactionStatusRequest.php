<?php

namespace App\Http\Requests;

use App\Models\TransactionStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTransactionStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_status_create');
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
