<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSurveyResponsesTable extends Migration
{
    public function up()
    {
        Schema::table('survey_responses', function (Blueprint $table) {
            $table->unsignedBigInteger('survey_id')->nullable();
            $table->foreign('survey_id', 'survey_fk_2909112')->references('id')->on('surveys');
            $table->unsignedBigInteger('responder_id')->nullable();
            $table->foreign('responder_id', 'responder_fk_2909113')->references('id')->on('survey_responders');
        });
    }
}
