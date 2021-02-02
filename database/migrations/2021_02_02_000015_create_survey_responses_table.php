<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyResponsesTable extends Migration
{
    public function up()
    {
        Schema::create('survey_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('response')->nullable();
            $table->integer('survey_detail');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
