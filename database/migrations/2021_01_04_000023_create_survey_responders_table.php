<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyRespondersTable extends Migration
{
    public function up()
    {
        Schema::create('survey_responders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('names')->nullable();
            $table->string('last_names')->nullable();
            $table->string('identification')->nullable();
            $table->string('email')->nullable();
            $table->date('dob')->nullable();
            $table->string('company')->nullable();
            $table->string('position')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
