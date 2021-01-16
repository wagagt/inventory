<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySurveyAskTypeRequest;
use App\Http\Requests\StoreSurveyAskTypeRequest;
use App\Http\Requests\UpdateSurveyAskTypeRequest;
use App\Models\SurveyAskType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyAskTypesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('survey_ask_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyAskTypes = SurveyAskType::all();

        return view('admin.surveyAskTypes.index', compact('surveyAskTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('survey_ask_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.surveyAskTypes.create');
    }

    public function store(StoreSurveyAskTypeRequest $request)
    {
        $surveyAskType = SurveyAskType::create($request->all());

        return redirect()->route('admin.survey-ask-types.index');
    }

    public function edit(SurveyAskType $surveyAskType)
    {
        abort_if(Gate::denies('survey_ask_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.surveyAskTypes.edit', compact('surveyAskType'));
    }

    public function update(UpdateSurveyAskTypeRequest $request, SurveyAskType $surveyAskType)
    {
        $surveyAskType->update($request->all());

        return redirect()->route('admin.survey-ask-types.index');
    }

    public function show(SurveyAskType $surveyAskType)
    {
        abort_if(Gate::denies('survey_ask_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyAskType->load('askTypeSurveyDetails');

        return view('admin.surveyAskTypes.show', compact('surveyAskType'));
    }

    public function destroy(SurveyAskType $surveyAskType)
    {
        abort_if(Gate::denies('survey_ask_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyAskType->delete();

        return back();
    }

    public function massDestroy(MassDestroySurveyAskTypeRequest $request)
    {
        SurveyAskType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
