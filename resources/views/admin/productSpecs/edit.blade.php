@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.productSpec.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.product-specs.update", [$productSpec->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.productSpec.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $productSpec->name) }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productSpec.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="value">{{ trans('cruds.productSpec.fields.value') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text" name="value" id="value" value="{{ old('value', $productSpec->value) }}">
                @if($errors->has('value'))
                    <span class="text-danger">{{ $errors->first('value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productSpec.fields.value_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.productSpec.fields.inputy_type') }}</label>
                <select class="form-control {{ $errors->has('inputy_type') ? 'is-invalid' : '' }}" name="inputy_type" id="inputy_type">
                    <option value disabled {{ old('inputy_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ProductSpec::INPUTY_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('inputy_type', $productSpec->inputy_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('inputy_type'))
                    <span class="text-danger">{{ $errors->first('inputy_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productSpec.fields.inputy_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.productSpec.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $product)
                        <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $productSpec->product->id ?? '') == $id ? 'selected' : '' }}>{{ $product }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <span class="text-danger">{{ $errors->first('product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productSpec.fields.product_helper') }}</span>
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