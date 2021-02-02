@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.surveyAnswerType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.survey-answer-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyAnswerType.fields.id') }}
                        </th>
                        <td>
                            {{ $surveyAnswerType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyAnswerType.fields.name') }}
                        </th>
                        <td>
                            {{ $surveyAnswerType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyAnswerType.fields.value') }}
                        </th>
                        <td>
                            {{ $surveyAnswerType->value }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.survey-answer-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#answer_type_survey_details" role="tab" data-toggle="tab">
                {{ trans('cruds.surveyDetail.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="answer_type_survey_details">
            @includeIf('admin.surveyAnswerTypes.relationships.answerTypeSurveyDetails', ['surveyDetails' => $surveyAnswerType->answerTypeSurveyDetails])
        </div>
    </div>
</div>

@endsection