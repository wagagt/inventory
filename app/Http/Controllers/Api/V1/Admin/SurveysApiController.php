<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSurveyRequest;
use App\Http\Requests\UpdateSurveyRequest;
use App\Http\Resources\Admin\SurveyResource;
use App\Models\Survey;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveysApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('survey_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyResource(Survey::with(['ubication', 'user'])->get());
    }

    public function store(StoreSurveyRequest $request)
    {
        $survey = Survey::create($request->all());

        return (new SurveyResource($survey))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Survey $survey)
    {
        abort_if(Gate::denies('survey_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyResource($survey->load(['ubication', 'user']));
    }

    public function update(UpdateSurveyRequest $request, Survey $survey)
    {
        $survey->update($request->all());

        return (new SurveyResource($survey))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Survey $survey)
    {
        abort_if(Gate::denies('survey_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $survey->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
