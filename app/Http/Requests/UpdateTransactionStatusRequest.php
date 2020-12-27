<?php

namespace App\Http\Requests;

use App\Models\TransactionStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTransactionStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_status_edit');
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
