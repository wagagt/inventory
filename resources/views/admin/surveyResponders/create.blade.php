@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.surveyResponder.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.survey-responders.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="names">{{ trans('cruds.surveyResponder.fields.names') }}</label>
                <input class="form-control {{ $errors->has('names') ? 'is-invalid' : '' }}" type="text" name="names" id="names" value="{{ old('names', '') }}">
                @if($errors->has('names'))
                    <span class="text-danger">{{ $errors->first('names') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.surveyResponder.fields.names_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="last_names">{{ trans('cruds.surveyResponder.fields.last_names') }}</label>
                <input class="form-control {{ $errors->has('last_names') ? 'is-invalid' : '' }}" type="text" name="last_names" id="last_names" value="{{ old('last_names', '') }}">
                @if($errors->has('last_names'))
                    <span class="text-danger">{{ $errors->first('last_names') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.surveyResponder.fields.last_names_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="identification">{{ trans('cruds.surveyResponder.fields.identification') }}</label>
                <input class="form-control {{ $errors->has('identification') ? 'is-invalid' : '' }}" type="text" name="identification" id="identification" value="{{ old('identification', '') }}">
                @if($errors->has('identification'))
                    <span class="text-danger">{{ $errors->first('identification') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.surveyResponder.fields.identification_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.surveyResponder.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.surveyResponder.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="dob">{{ trans('cruds.surveyResponder.fields.dob') }}</label>
                <input class="form-control date {{ $errors->has('dob') ? 'is-invalid' : '' }}" type="text" name="dob" id="dob" value="{{ old('dob') }}">
                @if($errors->has('dob'))
                    <span class="text-danger">{{ $errors->first('dob') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.surveyResponder.fields.dob_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company">{{ trans('cruds.surveyResponder.fields.company') }}</label>
                <input class="form-control {{ $errors->has('company') ? 'is-invalid' : '' }}" type="text" name="company" id="company" value="{{ old('company', '') }}">
                @if($errors->has('company'))
                    <span class="text-danger">{{ $errors->first('company') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.surveyResponder.fields.company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="position">{{ trans('cruds.surveyResponder.fields.position') }}</label>
                <input class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}" type="text" name="position" id="position" value="{{ old('position', '') }}">
                @if($errors->has('position'))
                    <span class="text-danger">{{ $errors->first('position') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.surveyResponder.fields.position_helper') }}</span>
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