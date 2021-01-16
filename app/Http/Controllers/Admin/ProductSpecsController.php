<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductSpecRequest;
use App\Http\Requests\StoreProductSpecRequest;
use App\Http\Requests\UpdateProductSpecRequest;
use App\Models\ProductsBase;
use App\Models\ProductSpec;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductSpecsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_spec_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSpecs = ProductSpec::with(['product'])->get();

        return view('admin.productSpecs.index', compact('productSpecs'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_spec_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = ProductsBase::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productSpecs.create', compact('products'));
    }

    public function store(StoreProductSpecRequest $request)
    {
        $productSpec = ProductSpec::create($request->all());

        return redirect()->route('admin.product-specs.index');
    }

    public function edit(ProductSpec $productSpec)
    {
        abort_if(Gate::denies('product_spec_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = ProductsBase::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productSpec->load('product');

        return view('admin.productSpecs.edit', compact('products', 'productSpec'));
    }

    public function update(UpdateProductSpecRequest $request, ProductSpec $productSpec)
    {
        $productSpec->update($request->all());

        return redirect()->route('admin.product-specs.index');
    }

    public function show(ProductSpec $productSpec)
    {
        abort_if(Gate::denies('product_spec_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSpec->load('product');

        return view('admin.productSpecs.show', compact('productSpec'));
    }

    public function destroy(ProductSpec $productSpec)
    {
        abort_if(Gate::denies('product_spec_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSpec->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductSpecRequest $request)
    {
        ProductSpec::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
