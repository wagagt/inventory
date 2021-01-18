<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductsBaseRequest;
use App\Http\Requests\UpdateProductsBaseRequest;
use App\Http\Resources\Admin\ProductsBaseResource;
use App\Models\ProductsBase;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductsBaseApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('products_base_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductsBaseResource(ProductsBase::with(['categories', 'providers'])->get());
    }

    public function store(StoreProductsBaseRequest $request)
    {
        $productsBase = ProductsBase::create($request->all());
        $productsBase->categories()->sync($request->input('categories', []));
        $productsBase->providers()->sync($request->input('providers', []));

        return (new ProductsBaseResource($productsBase))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProductsBase $productsBase)
    {
        abort_if(Gate::denies('products_base_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductsBaseResource($productsBase->load(['categories', 'providers']));
    }

    public function update(UpdateProductsBaseRequest $request, ProductsBase $productsBase)
    {
        $productsBase->update($request->all());
        $productsBase->categories()->sync($request->input('categories', []));
        $productsBase->providers()->sync($request->input('providers', []));

        return (new ProductsBaseResource($productsBase))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProductsBase $productsBase)
    {
        abort_if(Gate::denies('products_base_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productsBase->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
