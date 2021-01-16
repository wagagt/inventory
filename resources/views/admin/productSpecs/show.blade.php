@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productSpec.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-specs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productSpec.fields.id') }}
                        </th>
                        <td>
                            {{ $productSpec->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productSpec.fields.name') }}
                        </th>
                        <td>
                            {{ $productSpec->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productSpec.fields.value') }}
                        </th>
                        <td>
                            {{ $productSpec->value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productSpec.fields.inputy_type') }}
                        </th>
                        <td>
                            {{ App\Models\ProductSpec::INPUTY_TYPE_SELECT[$productSpec->inputy_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productSpec.fields.product') }}
                        </th>
                        <td>
                            {{ $productSpec->product->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-specs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection