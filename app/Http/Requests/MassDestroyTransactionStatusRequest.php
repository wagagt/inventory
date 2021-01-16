<?php

namespace App\Http\Requests;

use App\Models\TransactionStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTransactionStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('transaction_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:transaction_statuses,id',
        ];
    }
}
