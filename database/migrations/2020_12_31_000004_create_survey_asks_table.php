<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyAsksTable extends Migration
{
    public function up()
    {
        Schema::create('survey_asks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ask')->nullable();
            $table->string('answer')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
