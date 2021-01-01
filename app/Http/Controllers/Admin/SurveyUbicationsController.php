<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySurveyUbicationRequest;
use App\Http\Requests\StoreSurveyUbicationRequest;
use App\Http\Requests\UpdateSurveyUbicationRequest;
use App\Models\SurveyUbication;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyUbicationsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('survey_ubication_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyUbications = SurveyUbication::all();

        return view('admin.surveyUbications.index', compact('surveyUbications'));
    }

    public function create()
    {
        abort_if(Gate::denies('survey_ubication_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.surveyUbications.create');
    }

    public function store(StoreSurveyUbicationRequest $request)
    {
        $surveyUbication = SurveyUbication::create($request->all());

        return redirect()->route('admin.survey-ubications.index');
    }

    public function edit(SurveyUbication $surveyUbication)
    {
        abort_if(Gate::denies('survey_ubication_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.surveyUbications.edit', compact('surveyUbication'));
    }

    public function update(UpdateSurveyUbicationRequest $request, SurveyUbication $surveyUbication)
    {
        $surveyUbication->update($request->all());

        return redirect()->route('admin.survey-ubications.index');
    }

    public function show(SurveyUbication $surveyUbication)
    {
        abort_if(Gate::denies('survey_ubication_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyUbication->load('ubicationSurveys');

        return view('admin.surveyUbications.show', compact('surveyUbication'));
    }

    public function destroy(SurveyUbication $surveyUbication)
    {
        abort_if(Gate::denies('survey_ubication_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyUbication->delete();

        return back();
    }

    public function massDestroy(MassDestroySurveyUbicationRequest $request)
    {
        SurveyUbication::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
