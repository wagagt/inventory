@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.surveyDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.survey-details.update", [$surveyDetail->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="ask">{{ trans('cruds.surveyDetail.fields.ask') }}</label>
                <input class="form-control {{ $errors->has('ask') ? 'is-invalid' : '' }}" type="text" name="ask" id="ask" value="{{ old('ask', $surveyDetail->ask) }}">
                @if($errors->has('ask'))
                    <span class="text-danger">{{ $errors->first('ask') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.surveyDetail.fields.ask_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="response">{{ trans('cruds.surveyDetail.fields.response') }}</label>
                <input class="form-control {{ $errors->has('response') ? 'is-invalid' : '' }}" type="text" name="response" id="response" value="{{ old('response', $surveyDetail->response) }}">
                @if($errors->has('response'))
                    <span class="text-danger">{{ $errors->first('response') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.surveyDetail.fields.response_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="survey_id">{{ trans('cruds.surveyDetail.fields.survey') }}</label>
                <select class="form-control select2 {{ $errors->has('survey') ? 'is-invalid' : '' }}" name="survey_id" id="survey_id">
                    @foreach($surveys as $id => $survey)
                        <option value="{{ $id }}" {{ (old('survey_id') ? old('survey_id') : $surveyDetail->survey->id ?? '') == $id ? 'selected' : '' }}>{{ $survey }}</option>
                    @endforeach
                </select>
                @if($errors->has('survey'))
                    <span class="text-danger">{{ $errors->first('survey') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.surveyDetail.fields.survey_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ask_type_id">{{ trans('cruds.surveyDetail.fields.ask_type') }}</label>
                <select class="form-control select2 {{ $errors->has('ask_type') ? 'is-invalid' : '' }}" name="ask_type_id" id="ask_type_id">
                    @foreach($ask_types as $id => $ask_type)
                        <option value="{{ $id }}" {{ (old('ask_type_id') ? old('ask_type_id') : $surveyDetail->ask_type->id ?? '') == $id ? 'selected' : '' }}>{{ $ask_type }}</option>
                    @endforeach
                </select>
                @if($errors->has('ask_type'))
                    <span class="text-danger">{{ $errors->first('ask_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.surveyDetail.fields.ask_type_helper') }}</span>
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