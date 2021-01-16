<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProviderRequest;
use App\Http\Requests\StoreProviderRequest;
use App\Http\Requests\UpdateProviderRequest;
use App\Models\Provider;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProvidersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('provider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $providers = Provider::all();

        return view('admin.providers.index', compact('providers'));
    }

    public function create()
    {
        abort_if(Gate::denies('provider_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.providers.create');
    }

    public function store(StoreProviderRequest $request)
    {
        $provider = Provider::create($request->all());

        return redirect()->route('admin.providers.index');
    }

    public function edit(Provider $provider)
    {
        abort_if(Gate::denies('provider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.providers.edit', compact('provider'));
    }

    public function update(UpdateProviderRequest $request, Provider $provider)
    {
        $provider->update($request->all());

        return redirect()->route('admin.providers.index');
    }

    public function show(Provider $provider)
    {
        abort_if(Gate::denies('provider_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provider->load('providerProductsBases');

        return view('admin.providers.show', compact('provider'));
    }

    public function destroy(Provider $provider)
    {
        abort_if(Gate::denies('provider_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provider->delete();

        return back();
    }

    public function massDestroy(MassDestroyProviderRequest $request)
    {
        Provider::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
