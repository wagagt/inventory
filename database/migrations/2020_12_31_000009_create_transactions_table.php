<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->string('name');
            $table->integer('store_origin')->nullable();
            $table->integer('store_destiny')->nullable();
            $table->integer('customer')->nullable();
            $table->integer('provider')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
