@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.survey.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.surveys.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.survey.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.survey.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.survey.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.survey.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_start">{{ trans('cruds.survey.fields.date_start') }}</label>
                <input class="form-control datetime {{ $errors->has('date_start') ? 'is-invalid' : '' }}" type="text" name="date_start" id="date_start" value="{{ old('date_start') }}">
                @if($errors->has('date_start'))
                    <span class="text-danger">{{ $errors->first('date_start') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.survey.fields.date_start_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_end">{{ trans('cruds.survey.fields.date_end') }}</label>
                <input class="form-control datetime {{ $errors->has('date_end') ? 'is-invalid' : '' }}" type="text" name="date_end" id="date_end" value="{{ old('date_end') }}">
                @if($errors->has('date_end'))
                    <span class="text-danger">{{ $errors->first('date_end') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.survey.fields.date_end_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ubication_id">{{ trans('cruds.survey.fields.ubication') }}</label>
                <select class="form-control select2 {{ $errors->has('ubication') ? 'is-invalid' : '' }}" name="ubication_id" id="ubication_id">
                    @foreach($ubications as $id => $ubication)
                        <option value="{{ $id }}" {{ old('ubication_id') == $id ? 'selected' : '' }}>{{ $ubication }}</option>
                    @endforeach
                </select>
                @if($errors->has('ubication'))
                    <span class="text-danger">{{ $errors->first('ubication') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.survey.fields.ubication_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.survey.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.survey.fields.user_helper') }}</span>
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