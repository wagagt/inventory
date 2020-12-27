@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.transactionDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.transaction-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $transactionDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionDetail.fields.quantity') }}
                        </th>
                        <td>
                            {{ $transactionDetail->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionDetail.fields.transaction') }}
                        </th>
                        <td>
                            {{ $transactionDetail->transaction->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionDetail.fields.producto') }}
                        </th>
                        <td>
                            {{ $transactionDetail->producto->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionDetail.fields.product_stock') }}
                        </th>
                        <td>
                            {{ $transactionDetail->product_stock }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionDetail.fields.productname') }}
                        </th>
                        <td>
                            {{ $transactionDetail->productname->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.transaction-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection