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



@endsection