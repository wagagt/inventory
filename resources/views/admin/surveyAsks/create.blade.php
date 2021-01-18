@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.surveyAsk.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.survey-asks.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="ask">{{ trans('cruds.surveyAsk.fields.ask') }}</label>
                <input class="form-control {{ $errors->has('ask') ? 'is-invalid' : '' }}" type="text" name="ask" id="ask" value="{{ old('ask', '') }}">
                @if($errors->has('ask'))
                    <span class="text-danger">{{ $errors->first('ask') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.surveyAsk.fields.ask_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="answer">{{ trans('cruds.surveyAsk.fields.answer') }}</label>
                <input class="form-control {{ $errors->has('answer') ? 'is-invalid' : '' }}" type="text" name="answer" id="answer" value="{{ old('answer', '') }}">
                @if($errors->has('answer'))
                    <span class="text-danger">{{ $errors->first('answer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.surveyAsk.fields.answer_helper') }}</span>
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