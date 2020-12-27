<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTransactionDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->foreign('transaction_id', 'transaction_fk_2868835')->references('id')->on('transactions');
            $table->unsignedBigInteger('producto_id')->nullable();
            $table->foreign('producto_id', 'producto_fk_2868836')->references('id')->on('products_bases');
            $table->unsignedBigInteger('productname_id')->nullable();
            $table->foreign('productname_id', 'productname_fk_2868841')->references('id')->on('products');
        });
    }
}
