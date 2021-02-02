<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSurveyAnswerTypeRequest;
use App\Http\Requests\UpdateSurveyAnswerTypeRequest;
use App\Http\Resources\Admin\SurveyAnswerTypeResource;
use App\Models\SurveyAnswerType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyAnswerTypesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('survey_answer_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyAnswerTypeResource(SurveyAnswerType::all());
    }

    public function store(StoreSurveyAnswerTypeRequest $request)
    {
        $surveyAnswerType = SurveyAnswerType::create($request->all());

        return (new SurveyAnswerTypeResource($surveyAnswerType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SurveyAnswerType $surveyAnswerType)
    {
        abort_if(Gate::denies('survey_answer_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyAnswerTypeResource($surveyAnswerType);
    }

    public function update(UpdateSurveyAnswerTypeRequest $request, SurveyAnswerType $surveyAnswerType)
    {
        $surveyAnswerType->update($request->all());

        return (new SurveyAnswerTypeResource($surveyAnswerType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SurveyAnswerType $surveyAnswerType)
    {
        abort_if(Gate::denies('survey_answer_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyAnswerType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
