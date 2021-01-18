<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySurveyResponderRequest;
use App\Http\Requests\StoreSurveyResponderRequest;
use App\Http\Requests\UpdateSurveyResponderRequest;
use App\Models\SurveyResponder;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyRespondersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('survey_responder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyResponders = SurveyResponder::all();

        return view('admin.surveyResponders.index', compact('surveyResponders'));
    }

    public function create()
    {
        abort_if(Gate::denies('survey_responder_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.surveyResponders.create');
    }

    public function store(StoreSurveyResponderRequest $request)
    {
        $surveyResponder = SurveyResponder::create($request->all());

        return redirect()->route('admin.survey-responders.index');
    }

    public function edit(SurveyResponder $surveyResponder)
    {
        abort_if(Gate::denies('survey_responder_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.surveyResponders.edit', compact('surveyResponder'));
    }

    public function update(UpdateSurveyResponderRequest $request, SurveyResponder $surveyResponder)
    {
        $surveyResponder->update($request->all());

        return redirect()->route('admin.survey-responders.index');
    }

    public function show(SurveyResponder $surveyResponder)
    {
        abort_if(Gate::denies('survey_responder_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyResponder->load('responderSurveyResponses');

        return view('admin.surveyResponders.show', compact('surveyResponder'));
    }

    public function destroy(SurveyResponder $surveyResponder)
    {
        abort_if(Gate::denies('survey_responder_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyResponder->delete();

        return back();
    }

    public function massDestroy(MassDestroySurveyResponderRequest $request)
    {
        SurveyResponder::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
