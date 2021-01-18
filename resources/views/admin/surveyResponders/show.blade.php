@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.surveyResponder.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.survey-responders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyResponder.fields.id') }}
                        </th>
                        <td>
                            {{ $surveyResponder->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyResponder.fields.names') }}
                        </th>
                        <td>
                            {{ $surveyResponder->names }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyResponder.fields.last_names') }}
                        </th>
                        <td>
                            {{ $surveyResponder->last_names }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyResponder.fields.identification') }}
                        </th>
                        <td>
                            {{ $surveyResponder->identification }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyResponder.fields.email') }}
                        </th>
                        <td>
                            {{ $surveyResponder->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyResponder.fields.dob') }}
                        </th>
                        <td>
                            {{ $surveyResponder->dob }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyResponder.fields.company') }}
                        </th>
                        <td>
                            {{ $surveyResponder->company }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyResponder.fields.position') }}
                        </th>
                        <td>
                            {{ $surveyResponder->position }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.survey-responders.index') }}">
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
            <a class="nav-link" href="#responder_survey_responses" role="tab" data-toggle="tab">
                {{ trans('cruds.surveyResponse.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="responder_survey_responses">
            @includeIf('admin.surveyResponders.relationships.responderSurveyResponses', ['surveyResponses' => $surveyResponder->responderSurveyResponses])
        </div>
    </div>
</div>

@endsection