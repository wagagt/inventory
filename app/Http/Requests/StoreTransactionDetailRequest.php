<?php

namespace App\Http\Requests;

use App\Models\TransactionDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTransactionDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_detail_create');
    }

    public function rules()
    {
        return [
            'quantity'      => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'product_stock' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
