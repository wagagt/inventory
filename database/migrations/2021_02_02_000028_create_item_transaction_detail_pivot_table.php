<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemTransactionDetailPivotTable extends Migration
{
    public function up()
    {
        Schema::create('item_transaction_detail', function (Blueprint $table) {
            $table->unsignedBigInteger('transaction_detail_id');
            $table->foreign('transaction_detail_id', 'transaction_detail_id_fk_2886118')->references('id')->on('transaction_details')->onDelete('cascade');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id', 'item_id_fk_2886118')->references('id')->on('items')->onDelete('cascade');
        });
    }
}
