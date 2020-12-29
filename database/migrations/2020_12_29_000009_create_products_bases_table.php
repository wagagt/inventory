<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsBasesTable extends Migration
{
    public function up()
    {
        Schema::create('products_bases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('stock')->nullable();
            $table->string('min_stock')->nullable();
            $table->string('max_stock')->nullable();
            $table->string('marca')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
