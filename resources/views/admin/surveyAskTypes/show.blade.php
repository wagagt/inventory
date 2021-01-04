@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.surveyAskType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.survey-ask-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyAskType.fields.id') }}
                        </th>
                        <td>
                            {{ $surveyAskType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyAskType.fields.name') }}
                        </th>
                        <td>
                            {{ $surveyAskType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyAskType.fields.value') }}
                        </th>
                        <td>
                            {{ $surveyAskType->value }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.survey-ask-types.index') }}">
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
            <a class="nav-link" href="#ask_type_survey_details" role="tab" data-toggle="tab">
                {{ trans('cruds.surveyDetail.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="ask_type_survey_details">
            @includeIf('admin.surveyAskTypes.relationships.askTypeSurveyDetails', ['surveyDetails' => $surveyAskType->askTypeSurveyDetails])
        </div>
    </div>
</div>

@endsection