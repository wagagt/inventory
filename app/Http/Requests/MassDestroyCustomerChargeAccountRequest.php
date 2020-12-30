<?php

namespace App\Http\Requests;

use App\Models\CustomerChargeAccount;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCustomerChargeAccountRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('customer_charge_account_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:customer_charge_accounts,id',
        ];
    }
}
