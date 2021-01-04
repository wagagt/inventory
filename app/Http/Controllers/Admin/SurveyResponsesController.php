<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySurveyResponseRequest;
use App\Http\Requests\StoreSurveyResponseRequest;
use App\Http\Requests\UpdateSurveyResponseRequest;
use App\Models\Survey;
use App\Models\SurveyResponder;
use App\Models\SurveyResponse;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyResponsesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('survey_response_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyResponses = SurveyResponse::with(['survey', 'responder'])->get();

        return view('admin.surveyResponses.index', compact('surveyResponses'));
    }

    public function create()
    {
        abort_if(Gate::denies('survey_response_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveys = Survey::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responders = SurveyResponder::all()->pluck('names', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.surveyResponses.create', compact('surveys', 'responders'));
    }

    public function store(StoreSurveyResponseRequest $request)
    {
        $surveyResponse = SurveyResponse::create($request->all());

        return redirect()->route('admin.survey-responses.index');
    }

    public function edit(SurveyResponse $surveyResponse)
    {
        abort_if(Gate::denies('survey_response_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveys = Survey::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responders = SurveyResponder::all()->pluck('names', 'id')->prepend(trans('global.pleaseSelect'), '');

        $surveyResponse->load('survey', 'responder');

        return view('admin.surveyResponses.edit', compact('surveys', 'responders', 'surveyResponse'));
    }

    public function update(UpdateSurveyResponseRequest $request, SurveyResponse $surveyResponse)
    {
        $surveyResponse->update($request->all());

        return redirect()->route('admin.survey-responses.index');
    }

    public function show(SurveyResponse $surveyResponse)
    {
        abort_if(Gate::denies('survey_response_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyResponse->load('survey', 'responder');

        return view('admin.surveyResponses.show', compact('surveyResponse'));
    }

    public function destroy(SurveyResponse $surveyResponse)
    {
        abort_if(Gate::denies('survey_response_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyResponse->delete();

        return back();
    }

    public function massDestroy(MassDestroySurveyResponseRequest $request)
    {
        SurveyResponse::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
