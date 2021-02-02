<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSurveyDetailRequest;
use App\Http\Requests\UpdateSurveyDetailRequest;
use App\Http\Resources\Admin\SurveyDetailResource;
use App\Models\SurveyDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyDetailApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('survey_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyDetailResource(SurveyDetail::with(['survey', 'answer_type'])->get());
    }

    public function store(StoreSurveyDetailRequest $request)
    {
        $surveyDetail = SurveyDetail::create($request->all());

        return (new SurveyDetailResource($surveyDetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SurveyDetail $surveyDetail)
    {
        abort_if(Gate::denies('survey_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyDetailResource($surveyDetail->load(['survey', 'answer_type']));
    }

    public function update(UpdateSurveyDetailRequest $request, SurveyDetail $surveyDetail)
    {
        $surveyDetail->update($request->all());

        return (new SurveyDetailResource($surveyDetail))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SurveyDetail $surveyDetail)
    {
        abort_if(Gate::denies('survey_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyDetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
