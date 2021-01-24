@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.customerChargeAccount.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.customer-charge-accounts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.customerChargeAccount.fields.id') }}
                        </th>
                        <td>
                            {{ $customerChargeAccount->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerChargeAccount.fields.date') }}
                        </th>
                        <td>
                            {{ $customerChargeAccount->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerChargeAccount.fields.payment_type') }}
                        </th>
                        <td>
                            {{ App\Models\CustomerChargeAccount::PAYMENT_TYPE_SELECT[$customerChargeAccount->payment_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerChargeAccount.fields.amount') }}
                        </th>
                        <td>
                            {{ $customerChargeAccount->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerChargeAccount.fields.doc_no') }}
                        </th>
                        <td>
                            {{ $customerChargeAccount->doc_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerChargeAccount.fields.exchage_currency') }}
                        </th>
                        <td>
                            {{ $customerChargeAccount->exchage_currency }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerChargeAccount.fields.customer') }}
                        </th>
                        <td>
                            {{ $customerChargeAccount->customer->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerChargeAccount.fields.currency') }}
                        </th>
                        <td>
                            {{ App\Models\CustomerChargeAccount::CURRENCY_SELECT[$customerChargeAccount->currency] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.customer-charge-accounts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection