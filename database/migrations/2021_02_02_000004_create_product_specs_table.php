<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSpecsTable extends Migration
{
    public function up()
    {
        Schema::create('product_specs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('value')->nullable();
            $table->string('inputy_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
