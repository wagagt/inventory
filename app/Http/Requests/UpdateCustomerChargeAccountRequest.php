<?php

namespace App\Http\Requests;

use App\Models\CustomerChargeAccount;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCustomerChargeAccountRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('customer_charge_account_edit');
    }

    public function rules()
    {
        return [
            'date'         => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'payment_type' => [
                'required',
            ],
            'amount'       => [
                'required',
            ],
            'doc_no'       => [
                'string',
                'nullable',
            ],
            'currency'     => [
                'string',
                'nullable',
            ],
        ];
    }
}
