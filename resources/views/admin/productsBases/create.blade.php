@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.productsBase.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products-bases.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.productsBase.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productsBase.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.productsBase.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productsBase.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="stock">{{ trans('cruds.productsBase.fields.stock') }}</label>
                <input class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}" type="text" name="stock" id="stock" value="{{ old('stock', '0') }}">
                @if($errors->has('stock'))
                    <span class="text-danger">{{ $errors->first('stock') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productsBase.fields.stock_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="min_stock">{{ trans('cruds.productsBase.fields.min_stock') }}</label>
                <input class="form-control {{ $errors->has('min_stock') ? 'is-invalid' : '' }}" type="text" name="min_stock" id="min_stock" value="{{ old('min_stock', '0') }}">
                @if($errors->has('min_stock'))
                    <span class="text-danger">{{ $errors->first('min_stock') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productsBase.fields.min_stock_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="max_stock">{{ trans('cruds.productsBase.fields.max_stock') }}</label>
                <input class="form-control {{ $errors->has('max_stock') ? 'is-invalid' : '' }}" type="text" name="max_stock" id="max_stock" value="{{ old('max_stock', '0') }}">
                @if($errors->has('max_stock'))
                    <span class="text-danger">{{ $errors->first('max_stock') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productsBase.fields.max_stock_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="categories">{{ trans('cruds.productsBase.fields.category') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ in_array($id, old('categories', [])) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <span class="text-danger">{{ $errors->first('categories') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productsBase.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="providers">{{ trans('cruds.productsBase.fields.provider') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('providers') ? 'is-invalid' : '' }}" name="providers[]" id="providers" multiple>
                    @foreach($providers as $id => $provider)
                        <option value="{{ $id }}" {{ in_array($id, old('providers', [])) ? 'selected' : '' }}>{{ $provider }}</option>
                    @endforeach
                </select>
                @if($errors->has('providers'))
                    <span class="text-danger">{{ $errors->first('providers') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productsBase.fields.provider_helper') }}</span>
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