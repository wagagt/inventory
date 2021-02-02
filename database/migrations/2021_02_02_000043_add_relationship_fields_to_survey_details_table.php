<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSurveyDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('survey_details', function (Blueprint $table) {
            $table->unsignedBigInteger('survey_id')->nullable();
            $table->foreign('survey_id', 'survey_fk_2909087')->references('id')->on('surveys');
            $table->unsignedBigInteger('answer_type_id')->nullable();
            $table->foreign('answer_type_id', 'answer_type_fk_3104878')->references('id')->on('survey_answer_types');
        });
    }
}
