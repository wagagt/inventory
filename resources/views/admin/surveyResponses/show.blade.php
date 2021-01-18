@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.surveyResponse.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.survey-responses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyResponse.fields.id') }}
                        </th>
                        <td>
                            {{ $surveyResponse->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyResponse.fields.response') }}
                        </th>
                        <td>
                            {{ $surveyResponse->response }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyResponse.fields.survey_detail') }}
                        </th>
                        <td>
                            {{ $surveyResponse->survey_detail }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyResponse.fields.survey') }}
                        </th>
                        <td>
                            {{ $surveyResponse->survey->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyResponse.fields.responder') }}
                        </th>
                        <td>
                            {{ $surveyResponse->responder->names ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.survey-responses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection