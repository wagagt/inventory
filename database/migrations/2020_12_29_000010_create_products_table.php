<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->string('code')->nullable();
            $table->string('internal_code')->nullable();
            $table->integer('stock')->nullable();
            $table->integer('min_stock')->nullable();
            $table->integer('max_stock')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
