<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerChargeAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('customer_charge_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('date')->nullable();
            $table->string('payment_type');
            $table->decimal('amount', 15, 2);
            $table->string('doc_no')->nullable();
            $table->string('currency')->nullable();
            $table->decimal('exchage_currency', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
