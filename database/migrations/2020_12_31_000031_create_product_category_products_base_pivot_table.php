<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoryProductsBasePivotTable extends Migration
{
    public function up()
    {
        Schema::create('product_category_products_base', function (Blueprint $table) {
            $table->unsignedBigInteger('products_base_id');
            $table->foreign('products_base_id', 'products_base_id_fk_2868726')->references('id')->on('products_bases')->onDelete('cascade');
            $table->unsignedBigInteger('product_category_id');
            $table->foreign('product_category_id', 'product_category_id_fk_2868726')->references('id')->on('product_categories')->onDelete('cascade');
        });
    }
}
