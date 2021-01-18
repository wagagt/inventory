<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSurveyAskTypeRequest;
use App\Http\Requests\UpdateSurveyAskTypeRequest;
use App\Http\Resources\Admin\SurveyAskTypeResource;
use App\Models\SurveyAskType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyAskTypesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('survey_ask_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyAskTypeResource(SurveyAskType::all());
    }

    public function store(StoreSurveyAskTypeRequest $request)
    {
        $surveyAskType = SurveyAskType::create($request->all());

        return (new SurveyAskTypeResource($surveyAskType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SurveyAskType $surveyAskType)
    {
        abort_if(Gate::denies('survey_ask_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyAskTypeResource($surveyAskType);
    }

    public function update(UpdateSurveyAskTypeRequest $request, SurveyAskType $surveyAskType)
    {
        $surveyAskType->update($request->all());

        return (new SurveyAskTypeResource($surveyAskType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SurveyAskType $surveyAskType)
    {
        abort_if(Gate::denies('survey_ask_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyAskType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
