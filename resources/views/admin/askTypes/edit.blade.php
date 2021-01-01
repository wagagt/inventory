@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.askType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ask-types.update", [$askType->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.askType.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $askType->name) }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.askType.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="value">{{ trans('cruds.askType.fields.value') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text" name="value" id="value" value="{{ old('value', $askType->value) }}">
                @if($errors->has('value'))
                    <span class="text-danger">{{ $errors->first('value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.askType.fields.value_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ask_id">{{ trans('cruds.askType.fields.ask') }}</label>
                <select class="form-control select2 {{ $errors->has('ask') ? 'is-invalid' : '' }}" name="ask_id" id="ask_id">
                    @foreach($asks as $id => $ask)
                        <option value="{{ $id }}" {{ (old('ask_id') ? old('ask_id') : $askType->ask->id ?? '') == $id ? 'selected' : '' }}>{{ $ask }}</option>
                    @endforeach
                </select>
                @if($errors->has('ask'))
                    <span class="text-danger">{{ $errors->first('ask') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.askType.fields.ask_helper') }}</span>
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