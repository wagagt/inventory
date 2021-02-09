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
                <label for="answer_type_id">{{ trans('cruds.surveyDetail.fields.answer_type') }}</label>
                <select class="form-control select2 {{ $errors->has('answer_type') ? 'is-invalid' : '' }}" name="answer_type_id" id="answer_type_id">
                    @foreach($answer_types as $id => $answer_type)
                        <option value="{{ $id }}" {{ (old('answer_type_id') ? old('answer_type_id') : $surveyDetail->answer_type->id ?? '') == $id ? 'selected' : '' }}>{{ $answer_type }}</option>
                    @endforeach
                </select>
                @if($errors->has('answer_type'))
                    <span class="text-danger">{{ $errors->first('answer_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.surveyDetail.fields.answer_type_helper') }}</span>
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