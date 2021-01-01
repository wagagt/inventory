<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySurveyAskRequest;
use App\Http\Requests\StoreSurveyAskRequest;
use App\Http\Requests\UpdateSurveyAskRequest;
use App\Models\SurveyAsk;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyAsksController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('survey_ask_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyAsks = SurveyAsk::all();

        return view('admin.surveyAsks.index', compact('surveyAsks'));
    }

    public function create()
    {
        abort_if(Gate::denies('survey_ask_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.surveyAsks.create');
    }

    public function store(StoreSurveyAskRequest $request)
    {
        $surveyAsk = SurveyAsk::create($request->all());

        return redirect()->route('admin.survey-asks.index');
    }

    public function edit(SurveyAsk $surveyAsk)
    {
        abort_if(Gate::denies('survey_ask_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.surveyAsks.edit', compact('surveyAsk'));
    }

    public function update(UpdateSurveyAskRequest $request, SurveyAsk $surveyAsk)
    {
        $surveyAsk->update($request->all());

        return redirect()->route('admin.survey-asks.index');
    }

    public function show(SurveyAsk $surveyAsk)
    {
        abort_if(Gate::denies('survey_ask_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.surveyAsks.show', compact('surveyAsk'));
    }

    public function destroy(SurveyAsk $surveyAsk)
    {
        abort_if(Gate::denies('survey_ask_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyAsk->delete();

        return back();
    }

    public function massDestroy(MassDestroySurveyAskRequest $request)
    {
        SurveyAsk::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
