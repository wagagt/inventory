@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productsBase.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products-bases.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productsBase.fields.id') }}
                        </th>
                        <td>
                            {{ $productsBase->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productsBase.fields.name') }}
                        </th>
                        <td>
                            {{ $productsBase->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productsBase.fields.description') }}
                        </th>
                        <td>
                            {{ $productsBase->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productsBase.fields.stock') }}
                        </th>
                        <td>
                            {{ $productsBase->stock }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productsBase.fields.min_stock') }}
                        </th>
                        <td>
                            {{ $productsBase->min_stock }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productsBase.fields.max_stock') }}
                        </th>
                        <td>
                            {{ $productsBase->max_stock }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productsBase.fields.category') }}
                        </th>
                        <td>
                            @foreach($productsBase->categories as $key => $category)
                                <span class="label label-info">{{ $category->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productsBase.fields.provider') }}
                        </th>
                        <td>
                            @foreach($productsBase->providers as $key => $provider)
                                <span class="label label-info">{{ $provider->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productsBase.fields.marca') }}
                        </th>
                        <td>
                            {{ $productsBase->marca }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products-bases.index') }}">
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
            <a class="nav-link" href="#product_product_tags" role="tab" data-toggle="tab">
                {{ trans('cruds.productTag.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#product_product_specs" role="tab" data-toggle="tab">
                {{ trans('cruds.productSpec.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#product_items" role="tab" data-toggle="tab">
                {{ trans('cruds.item.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#producto_transaction_details" role="tab" data-toggle="tab">
                {{ trans('cruds.transactionDetail.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="product_product_tags">
            @includeIf('admin.productsBases.relationships.productProductTags', ['productTags' => $productsBase->productProductTags])
        </div>
        <div class="tab-pane" role="tabpanel" id="product_product_specs">
            @includeIf('admin.productsBases.relationships.productProductSpecs', ['productSpecs' => $productsBase->productProductSpecs])
        </div>
        <div class="tab-pane" role="tabpanel" id="product_items">
            @includeIf('admin.productsBases.relationships.productItems', ['items' => $productsBase->productItems])
        </div>
        <div class="tab-pane" role="tabpanel" id="producto_transaction_details">
            @includeIf('admin.productsBases.relationships.productoTransactionDetails', ['transactionDetails' => $productsBase->productoTransactionDetails])
        </div>
    </div>
</div>

@endsection