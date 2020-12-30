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
        });
    }
}
