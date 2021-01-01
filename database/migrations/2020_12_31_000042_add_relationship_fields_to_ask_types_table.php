<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAskTypesTable extends Migration
{
    public function up()
    {
        Schema::table('ask_types', function (Blueprint $table) {
            $table->unsignedBigInteger('ask_id')->nullable();
            $table->foreign('ask_id', 'ask_fk_2893368')->references('id')->on('survey_asks');
        });
    }
}
