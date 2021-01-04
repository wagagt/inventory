@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.surveyUbication.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.survey-ubications.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyUbication.fields.id') }}
                        </th>
                        <td>
                            {{ $surveyUbication->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyUbication.fields.name') }}
                        </th>
                        <td>
                            {{ $surveyUbication->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyUbication.fields.address') }}
                        </th>
                        <td>
                            {{ $surveyUbication->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyUbication.fields.zone') }}
                        </th>
                        <td>
                            {{ $surveyUbication->zone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyUbication.fields.city') }}
                        </th>
                        <td>
                            {{ $surveyUbication->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyUbication.fields.department') }}
                        </th>
                        <td>
                            {{ $surveyUbication->department }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.survey-ubications.index') }}">
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
            <a class="nav-link" href="#ubication_surveys" role="tab" data-toggle="tab">
                {{ trans('cruds.survey.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="ubication_surveys">
            @includeIf('admin.surveyUbications.relationships.ubicationSurveys', ['surveys' => $surveyUbication->ubicationSurveys])
        </div>
    </div>
</div>

@endsection