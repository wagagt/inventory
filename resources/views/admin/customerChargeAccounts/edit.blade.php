@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.customerChargeAccount.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.customer-charge-accounts.update", [$customerChargeAccount->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="date">{{ trans('cruds.customerChargeAccount.fields.date') }}</label>
                <input class="form-control datetime {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $customerChargeAccount->date) }}">
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customerChargeAccount.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.customerChargeAccount.fields.payment_type') }}</label>
                <select class="form-control {{ $errors->has('payment_type') ? 'is-invalid' : '' }}" name="payment_type" id="payment_type" required>
                    <option value disabled {{ old('payment_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CustomerChargeAccount::PAYMENT_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('payment_type', $customerChargeAccount->payment_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_type'))
                    <span class="text-danger">{{ $errors->first('payment_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customerChargeAccount.fields.payment_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.customerChargeAccount.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $customerChargeAccount->amount) }}" step="0.01" required>
                @if($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customerChargeAccount.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="doc_no">{{ trans('cruds.customerChargeAccount.fields.doc_no') }}</label>
                <input class="form-control {{ $errors->has('doc_no') ? 'is-invalid' : '' }}" type="text" name="doc_no" id="doc_no" value="{{ old('doc_no', $customerChargeAccount->doc_no) }}">
                @if($errors->has('doc_no'))
                    <span class="text-danger">{{ $errors->first('doc_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customerChargeAccount.fields.doc_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="currency">{{ trans('cruds.customerChargeAccount.fields.currency') }}</label>
                <input class="form-control {{ $errors->has('currency') ? 'is-invalid' : '' }}" type="text" name="currency" id="currency" value="{{ old('currency', $customerChargeAccount->currency) }}">
                @if($errors->has('currency'))
                    <span class="text-danger">{{ $errors->first('currency') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customerChargeAccount.fields.currency_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="exchage_currency">{{ trans('cruds.customerChargeAccount.fields.exchage_currency') }}</label>
                <input class="form-control {{ $errors->has('exchage_currency') ? 'is-invalid' : '' }}" type="number" name="exchage_currency" id="exchage_currency" value="{{ old('exchage_currency', $customerChargeAccount->exchage_currency) }}" step="0.01">
                @if($errors->has('exchage_currency'))
                    <span class="text-danger">{{ $errors->first('exchage_currency') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customerChargeAccount.fields.exchage_currency_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection