@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.provider.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.providers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.provider.fields.id') }}
                        </th>
                        <td>
                            {{ $provider->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provider.fields.name') }}
                        </th>
                        <td>
                            {{ $provider->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provider.fields.address') }}
                        </th>
                        <td>
                            {{ $provider->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provider.fields.zone') }}
                        </th>
                        <td>
                            {{ $provider->zone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provider.fields.city') }}
                        </th>
                        <td>
                            {{ $provider->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provider.fields.department') }}
                        </th>
                        <td>
                            {{ $provider->department }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provider.fields.contact_name') }}
                        </th>
                        <td>
                            {{ $provider->contact_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provider.fields.contact_email') }}
                        </th>
                        <td>
                            {{ $provider->contact_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provider.fields.contact_phone') }}
                        </th>
                        <td>
                            {{ $provider->contact_phone }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.providers.index') }}">
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
            <a class="nav-link" href="#provider_products_bases" role="tab" data-toggle="tab">
                {{ trans('cruds.productsBase.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="provider_products_bases">
            @includeIf('admin.providers.relationships.providerProductsBases', ['productsBases' => $provider->providerProductsBases])
        </div>
    </div>
</div>

@endsection