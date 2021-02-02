<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('serial_number')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->integer('transaction_detail')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
