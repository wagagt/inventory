<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('survey_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ask')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
