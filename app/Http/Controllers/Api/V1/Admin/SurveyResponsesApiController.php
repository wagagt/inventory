<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSurveyResponseRequest;
use App\Http\Requests\UpdateSurveyResponseRequest;
use App\Http\Resources\Admin\SurveyResponseResource;
use App\Models\SurveyResponse;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyResponsesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('survey_response_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyResponseResource(SurveyResponse::with(['survey', 'responder'])->get());
    }

    public function store(StoreSurveyResponseRequest $request)
    {
        $surveyResponse = SurveyResponse::create($request->all());

        return (new SurveyResponseResource($surveyResponse))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SurveyResponse $surveyResponse)
    {
        abort_if(Gate::denies('survey_response_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyResponseResource($surveyResponse->load(['survey', 'responder']));
    }

    public function update(UpdateSurveyResponseRequest $request, SurveyResponse $surveyResponse)
    {
        $surveyResponse->update($request->all());

        return (new SurveyResponseResource($surveyResponse))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SurveyResponse $surveyResponse)
    {
        abort_if(Gate::denies('survey_response_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyResponse->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
