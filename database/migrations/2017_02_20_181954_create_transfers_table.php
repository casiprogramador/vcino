<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('ori_account_id')->unsigned();
            $table->foreign('ori_account_id')->references('id')->on('accounts');
			$table->integer('des_account_id')->unsigned();
            $table->foreign('des_account_id')->references('id')->on('accounts');
			$table->integer('ori_transaction_id')->unsigned();
            $table->foreign('ori_transaction_id')->references('id')->on('transactions');
			$table->integer('des_transaction_id')->unsigned();
            $table->foreign('des_transaction_id')->references('id')->on('transactions');
			$table->string('adjunto')->nullable();
			$table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');
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
        Schema::drop('transfers');
    }
}
