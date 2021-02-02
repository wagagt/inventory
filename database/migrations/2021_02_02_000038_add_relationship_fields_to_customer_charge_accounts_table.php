<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCustomerChargeAccountsTable extends Migration
{
    public function up()
    {
        Schema::table('customer_charge_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id', 'customer_fk_3051120')->references('id')->on('crm_customers');
        });
    }
}
