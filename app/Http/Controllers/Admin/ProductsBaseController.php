<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductsBaseRequest;
use App\Http\Requests\StoreProductsBaseRequest;
use App\Http\Requests\UpdateProductsBaseRequest;
use App\Models\ProductCategory;
use App\Models\ProductsBase;
use App\Models\Provider;
use App\Models\Store;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductsBaseController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('products_base_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productsBases = ProductsBase::with(['categories', 'providers', 'store'])->get();

        return view('admin.productsBases.index', compact('productsBases'));
    }

    public function create()
    {
        abort_if(Gate::denies('products_base_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ProductCategory::all()->pluck('name', 'id');

        $providers = Provider::all()->pluck('name', 'id');

        $stores = Store::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productsBases.create', compact('categories', 'providers', 'stores'));
    }

    public function store(StoreProductsBaseRequest $request)
    {
        $productsBase = ProductsBase::create($request->all());
        $productsBase->categories()->sync($request->input('categories', []));
        $productsBase->providers()->sync($request->input('providers', []));

        return redirect()->route('admin.products-bases.index');
    }

    public function edit(ProductsBase $productsBase)
    {
        abort_if(Gate::denies('products_base_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ProductCategory::all()->pluck('name', 'id');

        $providers = Provider::all()->pluck('name', 'id');

        $stores = Store::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productsBase->load('categories', 'providers', 'store');

        return view('admin.productsBases.edit', compact('categories', 'providers', 'stores', 'productsBase'));
    }

    public function update(UpdateProductsBaseRequest $request, ProductsBase $productsBase)
    {
        $productsBase->update($request->all());
        $productsBase->categories()->sync($request->input('categories', []));
        $productsBase->providers()->sync($request->input('providers', []));

        return redirect()->route('admin.products-bases.index');
    }

    public function show(ProductsBase $productsBase)
    {
        abort_if(Gate::denies('products_base_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productsBase->load('categories', 'providers', 'store', 'productProductTags', 'productProductSpecs', 'productItems', 'productoTransactionDetails');

        return view('admin.productsBases.show', compact('productsBase'));
    }

    public function destroy(ProductsBase $productsBase)
    {
        abort_if(Gate::denies('products_base_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productsBase->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductsBaseRequest $request)
    {
        ProductsBase::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
