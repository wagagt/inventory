@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.askType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ask-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.askType.fields.id') }}
                        </th>
                        <td>
                            {{ $askType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.askType.fields.name') }}
                        </th>
                        <td>
                            {{ $askType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.askType.fields.value') }}
                        </th>
                        <td>
                            {{ $askType->value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.askType.fields.ask') }}
                        </th>
                        <td>
                            {{ $askType->ask->ask ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ask-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection