<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskAccountsreceivableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tasks_accountsreceivables', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('tasks');
			$table->integer('accountreceivable_id')->unsigned();
            $table->foreign('accountreceivable_id')->references('id')->on('accountsreceivables');
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
        //
    }
}
