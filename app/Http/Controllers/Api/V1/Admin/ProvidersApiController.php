<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProviderRequest;
use App\Http\Requests\UpdateProviderRequest;
use App\Http\Resources\Admin\ProviderResource;
use App\Models\Provider;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProvidersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('provider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProviderResource(Provider::all());
    }

    public function store(StoreProviderRequest $request)
    {
        $provider = Provider::create($request->all());

        return (new ProviderResource($provider))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Provider $provider)
    {
        abort_if(Gate::denies('provider_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProviderResource($provider);
    }

    public function update(UpdateProviderRequest $request, Provider $provider)
    {
        $provider->update($request->all());

        return (new ProviderResource($provider))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Provider $provider)
    {
        abort_if(Gate::denies('provider_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provider->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
