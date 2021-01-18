@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.survey.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.surveys.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.survey.fields.id') }}
                        </th>
                        <td>
                            {{ $survey->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.survey.fields.name') }}
                        </th>
                        <td>
                            {{ $survey->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.survey.fields.description') }}
                        </th>
                        <td>
                            {{ $survey->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.survey.fields.date_start') }}
                        </th>
                        <td>
                            {{ $survey->date_start }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.survey.fields.date_end') }}
                        </th>
                        <td>
                            {{ $survey->date_end }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.survey.fields.ubication') }}
                        </th>
                        <td>
                            {{ $survey->ubication->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.survey.fields.user') }}
                        </th>
                        <td>
                            {{ $survey->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.surveys.index') }}">
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
            <a class="nav-link" href="#survey_survey_details" role="tab" data-toggle="tab">
                {{ trans('cruds.surveyDetail.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#survey_survey_responses" role="tab" data-toggle="tab">
                {{ trans('cruds.surveyResponse.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="survey_survey_details">
            @includeIf('admin.surveys.relationships.surveySurveyDetails', ['surveyDetails' => $survey->surveySurveyDetails])
        </div>
        <div class="tab-pane" role="tabpanel" id="survey_survey_responses">
            @includeIf('admin.surveys.relationships.surveySurveyResponses', ['surveyResponses' => $survey->surveySurveyResponses])
        </div>
    </div>
</div>

@endsection
