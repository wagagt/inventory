@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.store.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.stores.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.store.fields.id') }}
                        </th>
                        <td>
                            {{ $store->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.store.fields.name') }}
                        </th>
                        <td>
                            {{ $store->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.store.fields.address') }}
                        </th>
                        <td>
                            {{ $store->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.store.fields.zone') }}
                        </th>
                        <td>
                            {{ $store->zone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.store.fields.city') }}
                        </th>
                        <td>
                            {{ $store->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.store.fields.department') }}
                        </th>
                        <td>
                            {{ $store->department }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.store.fields.user') }}
                        </th>
                        <td>
                            @foreach($store->users as $key => $user)
                                <span class="label label-info">{{ $user->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.stores.index') }}">
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
            <a class="nav-link" href="#store_items" role="tab" data-toggle="tab">
                {{ trans('cruds.item.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="store_items">
            @includeIf('admin.stores.relationships.storeItems', ['items' => $store->storeItems])
        </div>
    </div>
</div>

@endsection