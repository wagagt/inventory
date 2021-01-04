<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySurveyDetailRequest;
use App\Http\Requests\StoreSurveyDetailRequest;
use App\Http\Requests\UpdateSurveyDetailRequest;
use App\Models\Survey;
use App\Models\SurveyAskType;
use App\Models\SurveyDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyDetailController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('survey_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyDetails = SurveyDetail::with(['survey', 'ask_type'])->get();

        return view('admin.surveyDetails.index', compact('surveyDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('survey_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveys = Survey::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ask_types = SurveyAskType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.surveyDetails.create', compact('surveys', 'ask_types'));
    }

    public function store(StoreSurveyDetailRequest $request)
    {
        $surveyDetail = SurveyDetail::create($request->all());

        return redirect()->route('admin.survey-details.index');
    }

    public function edit(SurveyDetail $surveyDetail)
    {
        abort_if(Gate::denies('survey_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveys = Survey::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ask_types = SurveyAskType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $surveyDetail->load('survey', 'ask_type');

        return view('admin.surveyDetails.edit', compact('surveys', 'ask_types', 'surveyDetail'));
    }

    public function update(UpdateSurveyDetailRequest $request, SurveyDetail $surveyDetail)
    {
        $surveyDetail->update($request->all());

        return redirect()->route('admin.survey-details.index');
    }

    public function show(SurveyDetail $surveyDetail)
    {
        abort_if(Gate::denies('survey_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyDetail->load('survey', 'ask_type');

        return view('admin.surveyDetails.show', compact('surveyDetail'));
    }

    public function destroy(SurveyDetail $surveyDetail)
    {
        abort_if(Gate::denies('survey_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroySurveyDetailRequest $request)
    {
        SurveyDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
