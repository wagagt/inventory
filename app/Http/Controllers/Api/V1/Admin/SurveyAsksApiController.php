<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSurveyAskRequest;
use App\Http\Requests\UpdateSurveyAskRequest;
use App\Http\Resources\Admin\SurveyAskResource;
use App\Models\SurveyAsk;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyAsksApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('survey_ask_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyAskResource(SurveyAsk::all());
    }

    public function store(StoreSurveyAskRequest $request)
    {
        $surveyAsk = SurveyAsk::create($request->all());

        return (new SurveyAskResource($surveyAsk))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SurveyAsk $surveyAsk)
    {
        abort_if(Gate::denies('survey_ask_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyAskResource($surveyAsk);
    }

    public function update(UpdateSurveyAskRequest $request, SurveyAsk $surveyAsk)
    {
        $surveyAsk->update($request->all());

        return (new SurveyAskResource($surveyAsk))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SurveyAsk $surveyAsk)
    {
        abort_if(Gate::denies('survey_ask_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyAsk->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
