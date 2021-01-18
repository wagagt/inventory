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
                <label for="serial_number">{{ trans('cruds.item.fields.serial_number') }}</label>
                <input class="form-control {{ $errors->has('serial_number') ? 'is-invalid' : '' }}" type="text" name="serial_number" id="serial_number" value="{{ old('serial_number', $item->serial_number) }}">
                @if($errors->has('serial_number'))
                    <span class="text-danger">{{ $errors->first('serial_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.serial_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.item.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $item->price) }}" step="0.01">
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.price_helper') }}</span>
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
                <label for="store_id">{{ trans('cruds.item.fields.store') }}</label>
                <select class="form-control select2 {{ $errors->has('store') ? 'is-invalid' : '' }}" name="store_id" id="store_id">
                    @foreach($stores as $id => $store)
                        <option value="{{ $id }}" {{ (old('store_id') ? old('store_id') : $item->store->id ?? '') == $id ? 'selected' : '' }}>{{ $store }}</option>
                    @endforeach
                </select>
                @if($errors->has('store'))
                    <span class="text-danger">{{ $errors->first('store') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.store_helper') }}</span>
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