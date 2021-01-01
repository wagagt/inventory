<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSurveyUbicationRequest;
use App\Http\Requests\UpdateSurveyUbicationRequest;
use App\Http\Resources\Admin\SurveyUbicationResource;
use App\Models\SurveyUbication;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyUbicationsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('survey_ubication_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyUbicationResource(SurveyUbication::all());
    }

    public function store(StoreSurveyUbicationRequest $request)
    {
        $surveyUbication = SurveyUbication::create($request->all());

        return (new SurveyUbicationResource($surveyUbication))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SurveyUbication $surveyUbication)
    {
        abort_if(Gate::denies('survey_ubication_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyUbicationResource($surveyUbication);
    }

    public function update(UpdateSurveyUbicationRequest $request, SurveyUbication $surveyUbication)
    {
        $surveyUbication->update($request->all());

        return (new SurveyUbicationResource($surveyUbication))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SurveyUbication $surveyUbication)
    {
        abort_if(Gate::denies('survey_ubication_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyUbication->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
