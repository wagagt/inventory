@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.surveyResponse.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.survey-responses.update", [$surveyResponse->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="response">{{ trans('cruds.surveyResponse.fields.response') }}</label>
                <input class="form-control {{ $errors->has('response') ? 'is-invalid' : '' }}" type="text" name="response" id="response" value="{{ old('response', $surveyResponse->response) }}">
                @if($errors->has('response'))
                    <span class="text-danger">{{ $errors->first('response') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.surveyResponse.fields.response_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="survey_detail">{{ trans('cruds.surveyResponse.fields.survey_detail') }}</label>
                <input class="form-control {{ $errors->has('survey_detail') ? 'is-invalid' : '' }}" type="number" name="survey_detail" id="survey_detail" value="{{ old('survey_detail', $surveyResponse->survey_detail) }}" step="1" required>
                @if($errors->has('survey_detail'))
                    <span class="text-danger">{{ $errors->first('survey_detail') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.surveyResponse.fields.survey_detail_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="survey_id">{{ trans('cruds.surveyResponse.fields.survey') }}</label>
                <select class="form-control select2 {{ $errors->has('survey') ? 'is-invalid' : '' }}" name="survey_id" id="survey_id">
                    @foreach($surveys as $id => $survey)
                        <option value="{{ $id }}" {{ (old('survey_id') ? old('survey_id') : $surveyResponse->survey->id ?? '') == $id ? 'selected' : '' }}>{{ $survey }}</option>
                    @endforeach
                </select>
                @if($errors->has('survey'))
                    <span class="text-danger">{{ $errors->first('survey') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.surveyResponse.fields.survey_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="responder_id">{{ trans('cruds.surveyResponse.fields.responder') }}</label>
                <select class="form-control select2 {{ $errors->has('responder') ? 'is-invalid' : '' }}" name="responder_id" id="responder_id">
                    @foreach($responders as $id => $responder)
                        <option value="{{ $id }}" {{ (old('responder_id') ? old('responder_id') : $surveyResponse->responder->id ?? '') == $id ? 'selected' : '' }}>{{ $responder }}</option>
                    @endforeach
                </select>
                @if($errors->has('responder'))
                    <span class="text-danger">{{ $errors->first('responder') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.surveyResponse.fields.responder_helper') }}</span>
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