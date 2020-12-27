<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductSpecRequest;
use App\Http\Requests\UpdateProductSpecRequest;
use App\Http\Resources\Admin\ProductSpecResource;
use App\Models\ProductSpec;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductSpecsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_spec_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductSpecResource(ProductSpec::with(['product'])->get());
    }

    public function store(StoreProductSpecRequest $request)
    {
        $productSpec = ProductSpec::create($request->all());

        return (new ProductSpecResource($productSpec))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProductSpec $productSpec)
    {
        abort_if(Gate::denies('product_spec_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductSpecResource($productSpec->load(['product']));
    }

    public function update(UpdateProductSpecRequest $request, ProductSpec $productSpec)
    {
        $productSpec->update($request->all());

        return (new ProductSpecResource($productSpec))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProductSpec $productSpec)
    {
        abort_if(Gate::denies('product_spec_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSpec->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
