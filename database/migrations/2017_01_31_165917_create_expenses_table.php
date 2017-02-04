<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
			$table->integer('supplier_id')->unsigned();
            $table->foreign('supplier_id')->references('id')->on('suppliers');
			$table->integer('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on('accounts');
			$table->integer('transaction_id')->unsigned();
            $table->foreign('transaction_id')->references('id')->on('transactions');
			$table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');
			$table->string('adjunto')->nullable();
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
        Schema::drop('expenses');
    }
}
