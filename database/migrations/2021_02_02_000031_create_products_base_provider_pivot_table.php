<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsBaseProviderPivotTable extends Migration
{
    public function up()
    {
        Schema::create('products_base_provider', function (Blueprint $table) {
            $table->unsignedBigInteger('products_base_id');
            $table->foreign('products_base_id', 'products_base_id_fk_2868735')->references('id')->on('products_bases')->onDelete('cascade');
            $table->unsignedBigInteger('provider_id');
            $table->foreign('provider_id', 'provider_id_fk_2868735')->references('id')->on('providers')->onDelete('cascade');
        });
    }
}
