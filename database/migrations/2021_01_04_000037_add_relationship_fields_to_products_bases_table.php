<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductsBasesTable extends Migration
{
    public function up()
    {
        Schema::table('products_bases', function (Blueprint $table) {
            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id', 'store_fk_2886082')->references('id')->on('stores');
        });
    }
}
