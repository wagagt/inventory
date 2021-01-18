<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAskTypeRequest;
use App\Http\Requests\StoreAskTypeRequest;
use App\Http\Requests\UpdateAskTypeRequest;
use App\Models\AskType;
use App\Models\SurveyAsk;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AskTypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ask_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $askTypes = AskType::with(['ask'])->get();

        return view('admin.askTypes.index', compact('askTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('ask_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asks = SurveyAsk::all()->pluck('ask', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.askTypes.create', compact('asks'));
    }

    public function store(StoreAskTypeRequest $request)
    {
        $askType = AskType::create($request->all());

        return redirect()->route('admin.ask-types.index');
    }

    public function edit(AskType $askType)
    {
        abort_if(Gate::denies('ask_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asks = SurveyAsk::all()->pluck('ask', 'id')->prepend(trans('global.pleaseSelect'), '');

        $askType->load('ask');

        return view('admin.askTypes.edit', compact('asks', 'askType'));
    }

    public function update(UpdateAskTypeRequest $request, AskType $askType)
    {
        $askType->update($request->all());

        return redirect()->route('admin.ask-types.index');
    }

    public function show(AskType $askType)
    {
        abort_if(Gate::denies('ask_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $askType->load('ask');

        return view('admin.askTypes.show', compact('askType'));
    }

    public function destroy(AskType $askType)
    {
        abort_if(Gate::denies('ask_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $askType->delete();

        return back();
    }

    public function massDestroy(MassDestroyAskTypeRequest $request)
    {
        AskType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
