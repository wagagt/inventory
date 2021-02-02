<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySurveyAnswerTypeRequest;
use App\Http\Requests\StoreSurveyAnswerTypeRequest;
use App\Http\Requests\UpdateSurveyAnswerTypeRequest;
use App\Models\SurveyAnswerType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyAnswerTypesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('survey_answer_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyAnswerTypes = SurveyAnswerType::all();

        return view('admin.surveyAnswerTypes.index', compact('surveyAnswerTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('survey_answer_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.surveyAnswerTypes.create');
    }

    public function store(StoreSurveyAnswerTypeRequest $request)
    {
        $surveyAnswerType = SurveyAnswerType::create($request->all());

        return redirect()->route('admin.survey-answer-types.index');
    }

    public function edit(SurveyAnswerType $surveyAnswerType)
    {
        abort_if(Gate::denies('survey_answer_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.surveyAnswerTypes.edit', compact('surveyAnswerType'));
    }

    public function update(UpdateSurveyAnswerTypeRequest $request, SurveyAnswerType $surveyAnswerType)
    {
        $surveyAnswerType->update($request->all());

        return redirect()->route('admin.survey-answer-types.index');
    }

    public function show(SurveyAnswerType $surveyAnswerType)
    {
        abort_if(Gate::denies('survey_answer_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyAnswerType->load('answerTypeSurveyDetails');

        return view('admin.surveyAnswerTypes.show', compact('surveyAnswerType'));
    }

    public function destroy(SurveyAnswerType $surveyAnswerType)
    {
        abort_if(Gate::denies('survey_answer_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyAnswerType->delete();

        return back();
    }

    public function massDestroy(MassDestroySurveyAnswerTypeRequest $request)
    {
        SurveyAnswerType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
