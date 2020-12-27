@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.transactionDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transaction-details.update", [$transactionDetail->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="quantity">{{ trans('cruds.transactionDetail.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', $transactionDetail->quantity) }}" step="1" required>
                @if($errors->has('quantity'))
                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transactionDetail.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="transaction_id">{{ trans('cruds.transactionDetail.fields.transaction') }}</label>
                <select class="form-control select2 {{ $errors->has('transaction') ? 'is-invalid' : '' }}" name="transaction_id" id="transaction_id">
                    @foreach($transactions as $id => $transaction)
                        <option value="{{ $id }}" {{ (old('transaction_id') ? old('transaction_id') : $transactionDetail->transaction->id ?? '') == $id ? 'selected' : '' }}>{{ $transaction }}</option>
                    @endforeach
                </select>
                @if($errors->has('transaction'))
                    <span class="text-danger">{{ $errors->first('transaction') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transactionDetail.fields.transaction_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="producto_id">{{ trans('cruds.transactionDetail.fields.producto') }}</label>
                <select class="form-control select2 {{ $errors->has('producto') ? 'is-invalid' : '' }}" name="producto_id" id="producto_id">
                    @foreach($productos as $id => $producto)
                        <option value="{{ $id }}" {{ (old('producto_id') ? old('producto_id') : $transactionDetail->producto->id ?? '') == $id ? 'selected' : '' }}>{{ $producto }}</option>
                    @endforeach
                </select>
                @if($errors->has('producto'))
                    <span class="text-danger">{{ $errors->first('producto') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transactionDetail.fields.producto_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_stock">{{ trans('cruds.transactionDetail.fields.product_stock') }}</label>
                <input class="form-control {{ $errors->has('product_stock') ? 'is-invalid' : '' }}" type="number" name="product_stock" id="product_stock" value="{{ old('product_stock', $transactionDetail->product_stock) }}" step="1">
                @if($errors->has('product_stock'))
                    <span class="text-danger">{{ $errors->first('product_stock') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transactionDetail.fields.product_stock_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="productname_id">{{ trans('cruds.transactionDetail.fields.productname') }}</label>
                <select class="form-control select2 {{ $errors->has('productname') ? 'is-invalid' : '' }}" name="productname_id" id="productname_id">
                    @foreach($productnames as $id => $productname)
                        <option value="{{ $id }}" {{ (old('productname_id') ? old('productname_id') : $transactionDetail->productname->id ?? '') == $id ? 'selected' : '' }}>{{ $productname }}</option>
                    @endforeach
                </select>
                @if($errors->has('productname'))
                    <span class="text-danger">{{ $errors->first('productname') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transactionDetail.fields.productname_helper') }}</span>
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