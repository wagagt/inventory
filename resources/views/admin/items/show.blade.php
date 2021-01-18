@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.item.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.item.fields.id') }}
                        </th>
                        <td>
                            {{ $item->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.item.fields.product') }}
                        </th>
                        <td>
                            {{ $item->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.item.fields.serial_number') }}
                        </th>
                        <td>
                            {{ $item->serial_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.item.fields.price') }}
                        </th>
                        <td>
                            {{ $item->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.item.fields.transaction_detail') }}
                        </th>
                        <td>
                            {{ $item->transaction_detail }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.item.fields.store') }}
                        </th>
                        <td>
                            {{ $item->store->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.items.index') }}">
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
            <a class="nav-link" href="#item_transaction_details" role="tab" data-toggle="tab">
                {{ trans('cruds.transactionDetail.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="item_transaction_details">
            @includeIf('admin.items.relationships.itemTransactionDetails', ['transactionDetails' => $item->itemTransactionDetails])
        </div>
    </div>
</div>

@endsection