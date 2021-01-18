<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAskTypeRequest;
use App\Http\Requests\UpdateAskTypeRequest;
use App\Http\Resources\Admin\AskTypeResource;
use App\Models\AskType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AskTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ask_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AskTypeResource(AskType::with(['ask'])->get());
    }

    public function store(StoreAskTypeRequest $request)
    {
        $askType = AskType::create($request->all());

        return (new AskTypeResource($askType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AskType $askType)
    {
        abort_if(Gate::denies('ask_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AskTypeResource($askType->load(['ask']));
    }

    public function update(UpdateAskTypeRequest $request, AskType $askType)
    {
        $askType->update($request->all());

        return (new AskTypeResource($askType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AskType $askType)
    {
        abort_if(Gate::denies('ask_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $askType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
