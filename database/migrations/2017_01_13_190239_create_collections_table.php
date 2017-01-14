<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->increments('id');

			$table->string('cuotas');
			$table->integer('property_id')->unsigned();
            $table->foreign('property_id')->references('id')->on('properties');
			$table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');
			$table->integer('contact_id')->unsigned();
            $table->foreign('contact_id')->references('id')->on('contacts');
			$table->integer('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on('accounts');
			$table->integer('transaction_id')->unsigned();
            $table->foreign('transaction_id')->references('id')->on('transactions');
			
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('collections');
    }
}
