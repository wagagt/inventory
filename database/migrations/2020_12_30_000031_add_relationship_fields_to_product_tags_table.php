<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductTagsTable extends Migration
{
    public function up()
    {
        Schema::table('product_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_2868727')->references('id')->on('products_bases');
        });
    }
}
