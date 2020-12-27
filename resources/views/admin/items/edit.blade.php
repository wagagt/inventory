@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.item.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.items.update", [$item->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="code">{{ trans('cruds.item.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', $item->code) }}">
                @if($errors->has('code'))
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.item.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $product)
                        <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $item->product->id ?? '') == $id ? 'selected' : '' }}>{{ $product }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <span class="text-danger">{{ $errors->first('product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="transaction_detail">{{ trans('cruds.item.fields.transaction_detail') }}</label>
                <input class="form-control {{ $errors->has('transaction_detail') ? 'is-invalid' : '' }}" type="number" name="transaction_detail" id="transaction_detail" value="{{ old('transaction_detail', $item->transaction_detail) }}" step="1">
                @if($errors->has('transaction_detail'))
                    <span class="text-danger">{{ $errors->first('transaction_detail') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.transaction_detail_helper') }}</span>
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