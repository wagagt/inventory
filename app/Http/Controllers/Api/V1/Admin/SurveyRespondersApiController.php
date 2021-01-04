<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSurveyResponderRequest;
use App\Http\Requests\UpdateSurveyResponderRequest;
use App\Http\Resources\Admin\SurveyResponderResource;
use App\Models\SurveyResponder;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyRespondersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('survey_responder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyResponderResource(SurveyResponder::all());
    }

    public function store(StoreSurveyResponderRequest $request)
    {
        $surveyResponder = SurveyResponder::create($request->all());

        return (new SurveyResponderResource($surveyResponder))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SurveyResponder $surveyResponder)
    {
        abort_if(Gate::denies('survey_responder_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyResponderResource($surveyResponder);
    }

    public function update(UpdateSurveyResponderRequest $request, SurveyResponder $surveyResponder)
    {
        $surveyResponder->update($request->all());

        return (new SurveyResponderResource($surveyResponder))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SurveyResponder $surveyResponder)
    {
        abort_if(Gate::denies('survey_responder_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyResponder->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
